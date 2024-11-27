@extends('layouts.main-admin')

@section('title', 'Danh sách sinh viên')

@section('content')
@if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi xảy ra!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @endif
    
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold">Danh Sách Sinh Viên Đăng Ký Môn: {{ $monhoc->tenmonhoc }}</h2>
    <a href="{{ route('monhoc.createStudent', $monhoc->mamonhoc) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Thêm Sinh
                Viên</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Tên Sinh Viên</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($monhoc->dsDangKy as $index => $dangKy)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dangKy->mssv }}</td>
                    <td>{{ $dangKy->sinhvien->hoten }}</td>
                    <td>
                        <form action="{{ route('monhoc.deleteStudent', [$monhoc->mamonhoc, $dangKy->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá sinh viên này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Không có sinh viên nào đăng ký.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection