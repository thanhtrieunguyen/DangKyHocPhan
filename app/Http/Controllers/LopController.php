<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;


class LopController extends Controller
{
    public function index()
    {
        $query = LopHoc::query();
        $khoas = Khoa::all();
        $lops = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('lophoc.index', compact('lops', 'khoas'));
    }

    public function create() {
        $khoas = Khoa::all();
        return view('lophoc.create', compact('khoas'));
    }

    public function store(Request $request) {
        $request->validate([
            'tenlop' => 'required',
            'makhoa' => 'required',
        ]);

        $lop = new LopHoc();
        $lop->tenlop = $request->tenlop;
        $lop->makhoa = $request->makhoa;
        $lop->save();

        return redirect()->route('lophoc.index')->with('success', "Lớp {$lop->tenlop} đã được thêm thành công");
    }

    // public function show($id) {
    //     $lop = LopHoc::find($id);
    //     return view('lophoc.show', compact('lop'));
    // }

    public function edit($id) {
        $lop = LopHoc::find($id);
        $khoas = Khoa::all();
        return view('lophoc.edit', compact('lop', 'khoas'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'tenlop' => 'required',
            'makhoa' => 'required',
        ], [
            'makhoa.required' => 'Mã khoa là bắt buộc.',
        ]);

        $lop = LopHoc::find($id);
        $lop->tenlop = $request->tenlop;
        $lop->makhoa = $request->makhoa;
        $lop->save();

        return redirect()->route('lophoc.index')->with('success', "Lớp {$lop->tenlop} đã được cập nhật thành công");
    }

    public function destroy($id) {
        $lop = LopHoc::find($id);

        $hasRelatedRecords = DB::table('sinhvien')->where('malop', $id)->exists();

        if ($hasRelatedRecords) {
            return redirect()->route('lophoc.index')->with('error', 'Không thể xóa lớp học này vì lớp này đã có sinh viên.');
        }

        $lop->delete();


        return redirect()->route('lophoc.index')->with('success', "Lớp {$lop->tenlop} đã được xóa thành công");
    }

    public function getLops($makhoa)
    {
        $lops = LopHoc::where('makhoa', $makhoa)->get(); // Lấy danh sách lớp theo khoa
        return response()->json($lops);
    }
}
