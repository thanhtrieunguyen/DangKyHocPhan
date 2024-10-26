<?php

namespace App\Http\Controllers;

use App\Models\DSDangKy;
use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\Khoa;
use App\Models\SinhVien;
use Illuminate\Support\Facades\DB;


class MonHocController extends Controller
{
    // Hiển thị danh sách môn học
    public function index()
    {
        $monhocs = MonHoc::all();
        return view('monhoc.index', compact('monhocs'));
    }

    // Chuyển đến form thêm mới môn học
    public function create()
    {
        $khoas = Khoa::all();
        return view('monhoc.create', compact('khoas'));
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
            'makhoa' => 'required'
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

        // Parse the formatted lichhoc string into an array
        $lichhocData = $monhoc->lichhoc ? json_decode($monhoc->lichhoc, true) : [];

        // Prepare the parsed schedule for the view
        $parsedSchedule = [];
        if ($lichhocData) {
            foreach ($lichhocData as $item) {
                // Example format: "Thứ 2, 14h00-16h00"
                preg_match('/^(.*?), (\d{1,2}h\d{2})-(\d{1,2}h\d{2})$/', $item, $matches);
                if ($matches) {
                    $dayMap = [
                        'Thứ 2' => '2',
                        'Thứ 3' => '3',
                        'Thứ 4' => '4',
                        'Thứ 5' => '5',
                        'Thứ 6' => '6',
                        'Thứ 7' => '7',
                        'Chủ nhật' => '8'
                    ];
                    $day = $dayMap[$matches[1]] ?? null;
                    $startTime = $matches[2];
                    $endTime = $matches[3];

                    $lichhoc = json_decode($monhoc->lichhoc, true);
                    $parsedSchedule = [];
                    if ($lichhoc) {
                        foreach ($lichhoc as $schedule) {
                            $parsedSchedule[] = [
                                'day' => $schedule['day'],
                                'start_time' => $schedule['start_time'],
                                'end_time' => $schedule['end_time'],
                            ];
                        }
                    }
                }
            }
        }

        return view('monhoc.edit', compact('monhoc', 'khoas', 'parsedSchedule'));
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
        ]);

        $monhoc = MonHoc::findOrFail($mamonhoc);
        $monhoc->mamonhoc = $validatedData['mamonhoc'];
        $monhoc->tenmonhoc = $validatedData['tenmonhoc'];
        $monhoc->giangvien = $validatedData['giangvien'];
        $monhoc->sotinchi = $validatedData['sotinchi'];
        $monhoc->soluongsinhvien = $validatedData['soluongsinhvien'];
        $monhoc->makhoa = $validatedData['makhoa'];

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
