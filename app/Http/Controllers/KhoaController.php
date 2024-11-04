<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;


class KhoaController extends Controller
{
    public function index()
    {
        $query = Khoa::query()->withCount('lops');

        $khoas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('khoa.index', compact('khoas'));
    }

    public function create()
    {
        return view('khoa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'makhoa' => 'required',
            'tenkhoa' => 'required',
        ]);

        $khoa = new Khoa();
        $khoa->makhoa = $request->makhoa;
        $khoa->tenkhoa = $request->tenkhoa;
        $khoa->save();

        return redirect()->route('khoa.index')->with('success', "Khoa {$khoa->tenkhoa} đã được thêm thành công");
    }

    public function show($id)
    {
        $khoa = Khoa::find($id);
        return view('khoa.show', compact('khoa'));
    }

    public function edit($id)
    {
        $khoa = Khoa::find($id);
        return view('khoa.edit', compact('khoa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'makhoa' => 'required',
            'tenkhoa' => 'required',
        ]);

        $khoa = Khoa::find($id);
        $khoa->makhoa = $request->makhoa;
        $khoa->tenkhoa = $request->tenkhoa;
        $khoa->save();

        return redirect()->route('khoa.index')->with('success', "Khoa {$khoa->tenkhoa} đã được chỉnh sửa thành công");
    }

    public function destroy($id)
    {
        $khoa = Khoa::find($id);

        $hasRelatedRecords = DB::table('lophoc')->where('makhoa', $id)->exists();

        if ($hasRelatedRecords) {
            return redirect()->route('khoa.index')->with('error', 'Không thể xóa khoa này vì khoa này đã có lớp học.');
        }

        $khoa->delete();

        return redirect()->route('khoa.index')->with('success', "Khoa {$khoa->tenkhoa} đã được xóa thành công"); 
    }

    public function showLopHoc($makhoa)
    {
        $khoa = Khoa::with('lops')->where('makhoa', $makhoa)->first();

        if (!$khoa) {
            return redirect()->route('khoa.index')->with('error', 'Khoa không tồn tại.');
        }

        return view('khoa.lophoc', compact('khoa'));
    }

    public function deleteLopHoc($makhoa, $malop)
    {
        $lop = LopHoc::find($malop);

        if (!$lop) {
            return redirect()->back()->with('error', 'Lớp học không tồn tại.');
        }

        $hasRelatedRecords = DB::table('sinhvien')->where('malop', $malop)->exists();

        if ($hasRelatedRecords) {
            return redirect()->route('khoa.lophocs', $makhoa)->with('error', 'Không thể xóa lớp học này vì lớp này đã có sinh viên.');
        }

        $lop->delete();

        return redirect()->route('khoa.lophocs', $makhoa)->with('success', 'Xoá lớp học thành công.');
    }
}
