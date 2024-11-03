@extends('layouts.main-admin')

@section('title', 'Danh sách lớp học')
@section('content')

<!-- Success Notification -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1200
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
    <h2 class="text-2xl font-semibold">Danh Sách Lớp học có trong khoa: {{ $khoa->tenkhoa }}</h2>
    
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Lớp</th>
                <th>Tên Khoa</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($khoa->lops as $index => $lop)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $lop->tenlop }}</td>
                    <td>{{ $lop->khoa->tenkhoa }}</td>
                    <td>
                        <form action="{{ route('khoa.deleteLopHoc', [$khoa->makhoa, $lop->malop]) }}" method="POST">
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
