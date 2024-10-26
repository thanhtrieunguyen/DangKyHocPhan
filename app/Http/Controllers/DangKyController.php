<?php

namespace App\Http\Controllers;

use App\Models\DSDangKy;
use App\Models\SinhVien;
use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DangKyController extends Controller
{
    public function index()
    {
        $sinhvien = Auth::user();

        $monHocDaDangKy = $sinhvien->dsdangky->pluck('mamonhoc')->toArray();
        $monHocList = MonHoc::where('makhoa', $sinhvien->makhoa)
            ->whereNotIn('mamonhoc', $monHocDaDangKy)
            ->get();

        return view('dangky', compact('sinhvien', 'monHocList'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $sinhvien = Auth::user();
        $mssv = $sinhvien->mssv;

        // Tìm kiếm môn học theo từ khóa
        $monHocList = DB::table('sinhvien')
            ->join('lophoc', 'sinhvien.malop', '=', 'lophoc.malop')
            ->join('khoa', 'lophoc.makhoa', '=', 'khoa.makhoa')
            ->join('monhoc', 'khoa.makhoa', '=', 'monhoc.makhoa')
            ->where('sinhvien.mssv', $mssv)
            ->where('monhoc.tenmonhoc', 'LIKE', "%{$searchTerm}%")
            ->select('monhoc.*')
            ->get();

        return view('dangky', compact('sinhvien', 'monHocList'));
    }

    public function addMonHoc(Request $request)
    {
        $sinhvien = Auth::user();
        $mamonhoc = $request->input('mamonhoc');

        // Sử dụng transaction để đảm bảo tính toàn vẹn dữ liệu
        DB::transaction(function () use ($sinhvien, $mamonhoc) {
            // Lock hàng tương ứng trong bảng 'monhoc' để đảm bảo không có sinh viên khác đăng ký cùng lúc
            $monhoc = MonHoc::where('mamonhoc', $mamonhoc)->lockForUpdate()->first();

            // Kiểm tra số lượng đã đăng ký
            if ($monhoc && $monhoc->dadangky < $monhoc->soluongsinhvien) {
                // Thêm môn học vào bảng đăng ký
                DB::table('dsdangky')->insert([
                    'mamonhoc' => $mamonhoc,
                    'masinhvien' => $sinhvien->mssv,
                    'dstenmonhoc' => $monhoc->tenmonhoc,
                    'dsgiangvien' => $monhoc->giangvien,
                    'dssotinchi' => $monhoc->sotinchi,
                ]);

                // Cập nhật số lượng đã đăng ký
                $monhoc->dadangky += 1;
                $monhoc->save();

                // Trả về thông báo thành công
                return response()->json(['message' => 'Đăng ký học phần thành công!', 'redirect' => route('dangky')], 200);
            } else {
                // Thông báo lỗi nếu đã hết chỗ
                return response()->json(['message' => 'Môn học đã hết chỗ!'], 400);
            }
        });

        return response()->json(['message' => 'Đăng ký thành công!', 'redirect' => route('dangky')], 200);
    }



    // // ============== // //
    public function addMonHocWithoutTransaction(Request $request)
    {
        $sinhvien = Auth::user();
        $mamonhoc = $request->input('mamonhoc');

        // Lấy thông tin môn học
        $monhoc = MonHoc::where('mamonhoc', $mamonhoc)->first();

        // Kiểm tra nếu số lượng đã đăng ký nhỏ hơn số lượng sinh viên tối đa
        if ($monhoc && $monhoc->dadangky < $monhoc->soluongsinhvien) {
            DB::table('dsdangky')->insert([
                'mamonhoc' => $mamonhoc,
                'masinhvien' => $sinhvien->mssv,
                'dstenmonhoc' => $monhoc->tenmonhoc,
                'dsgiangvien' => $monhoc->giangvien,
                'dssotinchi' => $monhoc->sotinchi,
            ]);

            // Cập nhật số lượng đã đăng ký
            $monhoc->dadangky += 1;
            $monhoc->save();

            // Trả về thông báo thành công
            return response()->json(['message' => 'Đăng ký học phần thành công!', 'redirect' => route('dangky')], 200);
        } else {
            // Thông báo lỗi nếu đã hết chỗ
            return response()->json(['message' => 'Môn học đã hết chỗ!'], 400);
        }
    }




    public function ketQuaDangKy()
    {
        $sinhvien = Auth::user();
        $mssv = $sinhvien->mssv;
        $hoten = $sinhvien->hoten;
        // Lấy danh sách đăng ký của sinh viên
        $dsDangKy = DSDangKy::with('monHoc')
            ->where('masinhvien', $mssv)
            ->get();

        return view('ketquadangky', compact('sinhvien', 'dsDangKy', 'hoten'));
    }

    public function deleteDangKy($mamonhoc)
    {
        $sinhvien = Auth::user();
        $mssv = $sinhvien->mssv;

        // Lấy thông tin môn học từ bảng monhoc
        $monhoc = DB::table('monhoc')->where('mamonhoc', $mamonhoc)->first();

        // Kiểm tra nếu môn học tồn tại
        if ($monhoc) {
            // Xóa học phần từ bảng `dsdangky` với `masinhvien` và `mamonhoc` tương ứng
            DB::table('dsdangky')->where([
                ['masinhvien', '=', $mssv],
                ['mamonhoc', '=', $mamonhoc]
            ])->delete();

            // Cập nhật lại giá trị `dadangky` trong bảng `monhoc`
            $newDaDangKy = $monhoc->dadangky - 1; // Giảm giá trị `dadangky` đi 1
            DB::table('monhoc')->where('mamonhoc', $mamonhoc)->update(['dadangky' => $newDaDangKy]);

            // Chuyển hướng về trang kết quả đăng ký với thông báo thành công
            return redirect()->route('ketquadangky')->with('success', 'Xóa học phần thành công!');
        }

        // Nếu môn học không tồn tại, chuyển hướng với thông báo lỗi
        return redirect()->route('ketquadangky')->with('error', 'Môn học không tồn tại!');
    }
}
