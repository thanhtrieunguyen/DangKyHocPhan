<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $mssv = Auth::user()->mssv;

        $sinhvien = SinhVien::with('lop')->where('mssv', $mssv)->first();

        return view('profile.profile', compact('sinhvien'));
    }

    public function editProfile($mssv)
    {
        $sinhvien = SinhVien::where('mssv', $mssv)->firstOrFail();
        $lops = DB::table('lophoc')
            ->join('khoa', 'lophoc.makhoa', '=', 'khoa.makhoa')
            ->join('sinhvien', 'lophoc.malop', '=', 'sinhvien.malop')
            ->select('lophoc.malop', 'tenlop', 'tenkhoa', 'khoa.makhoa')
            ->get();
            
        return view('profile.edit', compact('sinhvien', 'lops'));
    }

    // public function updateProfile(Request $request, $mssv)
    // {
    //     $sinhvien = SinhVien::where('mssv', $mssv)->first();
    //     // Lấy thông tin lớp học để tìm makhoa tương ứng
    //     $lop = LopHoc::where('malop', $request->input('lop'))->first();

    //     // Kiểm tra và chỉ cập nhật những trường thay đổi
    //     if ($request->input('hoten') !== $sinhvien->hoten) {
    //         $sinhvien->hoten = $request->input('hoten');
    //     }

    //     if ($request->input('ngaysinh') !== $sinhvien->ngaysinh) {
    //         $sinhvien->ngaysinh = $request->input('ngaysinh');
    //     }

    //     if ($request->input('gioitinh') !== $sinhvien->gioitinh) {
    //         $sinhvien->gioitinh = $request->input('gioitinh');
    //     }

    //     if ($request->input('lop') !== $sinhvien->malop) {
    //         $sinhvien->malop = $lop->malop;
    //         $sinhvien->makhoa = $lop->makhoa;  // Cập nhật `makhoa` tương ứng nếu lớp học thay đổi
    //     }

    //     if ($request->input('quequan') !== $sinhvien->quequan) {
    //         $sinhvien->quequan = $request->input('quequan');
    //     }

    //     // Lưu các thay đổi vào cơ sở dữ liệu nếu có sự thay đổi
    //     if ($sinhvien->isDirty()) {
    //         $sinhvien->save();
    //     }

    //     return redirect()->route('profile')
    //         ->with('success', 'Cập nhật thông tin thành công!');
    // }


    public function updateWithoutTransaction(Request $request, $mssv)
    {
        $sinhvien = SinhVien::where('mssv', $mssv)->firstOrFail();
        $lop = LopHoc::where('malop', $request->input('lop'))->first();

        // Kiểm tra và chỉ cập nhật những trường thay đổi
        if ($request->input('hoten') !== $sinhvien->hoten) {
            $sinhvien->hoten = $request->input('hoten');
        }

        if ($request->input('ngaysinh') !== $sinhvien->ngaysinh) {
            $sinhvien->ngaysinh = $request->input('ngaysinh');
        }

        if ($request->input('gioitinh') !== $sinhvien->gioitinh) {
            $sinhvien->gioitinh = $request->input('gioitinh');
        }

        if ($request->input('lop') !== $sinhvien->malop) {
            $sinhvien->malop = $lop->malop;
            $sinhvien->makhoa = $lop->makhoa;
        }

        if ($request->input('quequan') !== $sinhvien->quequan) {
            $sinhvien->quequan = $request->input('quequan');
        }

        // Lưu các thay đổi vào cơ sở dữ liệu
        $sinhvien->save();

        return redirect()->route('profile')->with('success', 'Cập nhật sinh viên thành công');
    }

    public function updateWithTransaction(Request $request, $mssv)
    {
        $sinhvien = SinhVien::where('mssv', $mssv)->firstOrFail();

        // Kiểm tra giá trị updated_at từ request và database
        if ($request->input('updated_at') != $sinhvien->updated_at) {
            // Nếu không khớp, trả về thông báo lỗi
            return redirect()->back()->with('error', 'Dữ liệu đã thay đổi bởi người khác. Vui lòng tải lại trang và thử lại.');
        }

        // Cập nhật các trường
        $sinhvien->hoten = $request->input('hoten');
        $sinhvien->ngaysinh = $request->input('ngaysinh');
        $sinhvien->gioitinh = $request->input('gioitinh');
        $sinhvien->malop = $request->input('lop');
        $sinhvien->quequan = $request->input('quequan');

        try {
            $sinhvien->save();
            return redirect()->route('profile')->with('success', 'Cập nhật sinh viên thành công');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra xem lỗi có phải do concurrency không
            if ($e->getCode() === '23505') { // Mã lỗi có thể khác nhau
                return redirect()->back()->with('error', 'Dữ liệu đã bị thay đổi. Vui lòng tải lại trang.');
            }
            throw $e; // Ném lỗi khác
        }
    }
}
