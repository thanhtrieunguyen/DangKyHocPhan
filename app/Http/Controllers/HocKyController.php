<?php

namespace App\Http\Controllers;

use App\Models\HocKy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HocKyController extends Controller
{
    public function index()
    {
        $query = HocKy::query();

        $hockys = DB::table('hocky')->orderBy('namhoc', 'desc')->get();
        return view('hocky.index', compact('hockys'));
    }
    public function create()
    {
        return view('hocky.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'mahocky' => 'required', 'unique:hocky|max:255',
            'tenhocky' => 'required',
            'namhoc' => 'required',
            'ngaybatdau' => 'required|date',
            'ngayketthuc' => 'required|date',
        ]);

        $hocky = new HocKy();
        $hocky->mahocky = $request->mahocky;
        $hocky->tenhocky = $request->tenhocky;
        $hocky->namhoc = $request->namhoc;
        $hocky->ngaybatdau = $request->ngaybatdau;
        $hocky->ngayketthuc = $request->ngayketthuc;

        $hocky->save();

        return redirect()->route('hocky.index')->with('success', "Học kỳ {$hocky->tenhocky} đã được thêm thành công");
    }
    
    public function edit($mahocky)
    {
        $hocky = HocKy::where('mahocky', $mahocky)->first();
        return view('hocky.edit', compact('hocky'));
    }

    public function update(Request $request, $mahocky)
    {
        $request->validate([
            'mahocky' => 'required',
            'tenhocky' => 'required',
            'namhoc' => 'required',
            'ngaybatdau' => 'required|date',
            'ngayketthuc' => 'required|date',
        ]);

        $hocky = HocKy::where('mahocky', $mahocky)->first();
        $hocky->mahocky = $request->mahocky;
        $hocky->tenhocky = $request->tenhocky;
        $hocky->namhoc = $request->namhoc;
        $hocky->ngaybatdau = $request->ngaybatdau;
        $hocky->ngayketthuc = $request->ngayketthuc;

        $hocky->save();

        return redirect()->route('hocky.index')->with('success', "Học kỳ {$hocky->tenhocky} đã được cập nhật thành công");
    }
    public function destroy($mahocky)
    {
        $hocky = HocKy::where('mahocky', $mahocky)->first();
        $hasRelatedRecords = DB::table('hocky')->where('mahocky', $mahocky)->exists();
        $hasRelatedStudentRecords = DB::table('hocky_sinhvien')->where('mahocky', $mahocky)->exists();

        if ($hasRelatedRecords || $hasRelatedStudentRecords) {
            return redirect()->route('hocky.index')->with('error', 'Không thể xóa học kỳ này vì đã có môn học hoặc sinh viên liên quan.');
        }

        $hocky->delete();

        return redirect()->route('hocky.index')->with('success', "Học kỳ {$hocky->tenhocky} đã được xóa thành công");
    }
    
}
