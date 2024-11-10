<?php

namespace App\Http\Controllers;

use App\Models\DSDangKy;
use App\Models\HocKy;
use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\Khoa;
use App\Models\SinhVien;
use Illuminate\Support\Facades\DB;


class MonHocController extends Controller
{
    // Hiển thị danh sách môn học
    public function index(Request $request)
    {
        $query = MonHoc::query();

        // Lấy danh sách khoa và học kỳ để hiển thị trong select
        $khoas = Khoa::all();
        $hockys = HocKy::orderBy('ngaybatdau', 'desc')->get();

        // Kiểm tra nếu có filter theo khoa
        if ($request->has('makhoa') && $request->makhoa != '') {
            $query->where('makhoa', $request->makhoa);
        }

        // Kiểm tra nếu có filter theo học kỳ
        if ($request->has('hocky') && $request->hocky != '') {
            $query->where('mahocky', $request->hocky);
        }

        // Sắp xếp và phân trang
        $monhocs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('monhoc.index', compact('monhocs', 'khoas', 'hockys'));
    }

    // Chuyển đến form thêm mới môn học
    public function create()
    {
        $khoas = Khoa::all();
        $hockys = HocKy::orderBy('ngaybatdau', 'desc')->get();
        return view('monhoc.create', compact('khoas', 'hockys'));
    }

    // Thêm mới môn học
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mamonhoc' => 'required|unique:monhoc|max:255',
            'tenmonhoc' => 'required',
            'giangvien' => 'required',
            'sotinchi' => 'required|integer',
            'soluongsinhvien' => 'required|integer',
            'lichhoc' => 'required|json',
            'makhoa' => 'required',
            'mahocky' => 'required',
        ]);

        $lichhoc = json_decode($validatedData['lichhoc'], true);
        $formattedLichhoc = $this->formatLichhoc($lichhoc);

        $monhoc = new MonHoc();
        $monhoc->mamonhoc = $validatedData['mamonhoc'];
        $monhoc->tenmonhoc = $validatedData['tenmonhoc'];
        $monhoc->giangvien = $validatedData['giangvien'];
        $monhoc->sotinchi = $validatedData['sotinchi'];
        $monhoc->soluongsinhvien = $validatedData['soluongsinhvien'];
        $monhoc->makhoa = $validatedData['makhoa'];
        $monhoc->mahocky = $validatedData['mahocky'];
        $monhoc->lichhoc = $formattedLichhoc;

        $monhoc->save();

        return redirect()->route('monhoc.index')->with('success', 'Môn học đã được thêm thành công');
    }

    private function formatLichhoc($lichhocData)
    {
        $dayMap = [
            '2' => 'Thứ 2',
            '3' => 'Thứ 3',
            '4' => 'Thứ 4',
            '5' => 'Thứ 5',
            '6' => 'Thứ 6',
            '7' => 'Thứ 7',
            '8' => 'Chủ nhật'
        ];

        $formattedSchedules = [];

        foreach ($lichhocData as $schedule) {
            $day = $dayMap[$schedule['day']] ?? 'Không xác định';
            $startTime = date('H\hi', strtotime($schedule['start_time']));
            $endTime = date('H\hi', strtotime($schedule['end_time']));

            $formattedSchedules[] = "{$day}, {$startTime}-{$endTime}";
        }

        return implode('; ', $formattedSchedules);
    }

    // Chỉnh sửa môn học
    public function edit($mamonhoc)
    {
        $monhoc = MonHoc::find($mamonhoc);
        $khoas = Khoa::all();
        $hockys = HocKy::orderBy('ngaybatdau', 'desc')->get();

        $parsedSchedule = [];
        if ($monhoc->lichhoc) {
            $schedules = explode(';', $monhoc->lichhoc);
            foreach ($schedules as $schedule) {
                // Trim để loại bỏ khoảng trắng thừa
                $schedule = trim($schedule);

                // Parse thông tin từ chuỗi "Thứ x, HHhmm-HHhmm"
                if (preg_match('/^(Thứ \d|Chủ nhật), (\d{2})h(\d{2})-(\d{2})h(\d{2})$/', $schedule, $matches)) {
                    $dayMap = [
                        'Thứ 2' => '2',
                        'Thứ 3' => '3',
                        'Thứ 4' => '4',
                        'Thứ 5' => '5',
                        'Thứ 6' => '6',
                        'Thứ 7' => '7',
                        'Chủ nhật' => '8'
                    ];

                    $day = $dayMap[$matches[1]] ?? '';
                    $startHour = $matches[2];
                    $startMinute = $matches[3];
                    $endHour = $matches[4];
                    $endMinute = $matches[5];

                    $parsedSchedule[] = [
                        'day' => $day,
                        'start_time' => sprintf('%02d:%02d', $startHour, $startMinute),
                        'end_time' => sprintf('%02d:%02d', $endHour, $endMinute)
                    ];
                }
            }
        }

        return view('monhoc.edit', compact('monhoc', 'khoas', 'hockys', 'parsedSchedule'));
    }


    // Cập nhật môn học
    public function update(Request $request, $mamonhoc)
    {
        $validatedData = $request->validate([
            'mamonhoc' => 'required|max:255',
            'tenmonhoc' => 'required',
            'giangvien' => 'required',
            'sotinchi' => 'required|integer',
            'soluongsinhvien' => 'required|integer',
            'lichhoc' => 'nullable|json',
            'makhoa' => 'required',
            'mahocky' => 'required',
        ]);

        $monhoc = MonHoc::findOrFail($mamonhoc);
        $monhoc->mamonhoc = $validatedData['mamonhoc'];
        $monhoc->tenmonhoc = $validatedData['tenmonhoc'];
        $monhoc->giangvien = $validatedData['giangvien'];
        $monhoc->sotinchi = $validatedData['sotinchi'];
        $monhoc->soluongsinhvien = $validatedData['soluongsinhvien'];
        $monhoc->makhoa = $validatedData['makhoa'];
        $monhoc->mahocky = $validatedData['mahocky'];

        if ($request->has('noSchedule') && $request->noSchedule === 'on') {
            $monhoc->lichhoc = null;
        } else {
            $lichhocData = json_decode($validatedData['lichhoc'], true);
            $monhoc->lichhoc = $this->formatLichhoc($lichhocData);
        }

        $monhoc->save();

        return redirect()->route('monhoc.index')->with('success', 'Cập nhật môn học thành công');
    }

    // Xóa môn học
    public function destroy($mamonhoc)
    {
        $monhoc = MonHoc::find($mamonhoc);

        $hasRelatedRecords = DB::table('dsdangky')->where('mamonhoc', $mamonhoc)->exists();

        if ($hasRelatedRecords) {
            return redirect()->route('monhoc.index')->with('error', 'Không thể xóa môn học này vì đã có sinh viên đăng ký.');
        }

        // Nếu không có liên kết, thực hiện xóa
        $monhoc->delete();

        return redirect()->route('monhoc.index')->with('success', 'Môn học đã được xóa thành công');
    }


    // Hiển thị danh sách sinh viên đã đăng ký môn học
    public function showStudents($mamonhoc)
    {
        $monhoc = MonHoc::with('dsDangKy.sinhvien')->where('mamonhoc', $mamonhoc)->first();

        if (!$monhoc) {
            return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại.');
        }

        return view('monhoc.sinhvien', compact('monhoc'));
    }

    public function deleteStudent($mamonhoc, $dangKyId)
    {
        $dangKy = DSDangKy::find($dangKyId);

        if (!$dangKy) {
            return redirect()->back()->with('error', 'Đăng ký không tồn tại.');
        }

        // Lấy thông tin môn học và giảm giá trị dadangky
        $monhoc = MonHoc::where('mamonhoc', $mamonhoc)->first();

        if ($monhoc) {
            $monhoc->dadangky = max(0, $monhoc->dadangky - 1); // Đảm bảo dadangky không giảm xuống dưới 0
            $monhoc->save();
        }

        // Xoá đăng ký sinh viên
        $dangKy->delete();

        return redirect()->route('monhoc.sinhviens', $mamonhoc)->with('success', 'Xoá sinh viên thành công.');
    }
}
