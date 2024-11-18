@extends('layouts.main')

@section('title', 'Thông tin sinh viên')


@section('content')
    <style>
        td {
            height: 50px;
            text-align: center;
            font-size: 18px
        }
    </style>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi xảy ra!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
            <?php session()->forget('error'); ?>
        </script>
    @endif

    <!-- Success Notification -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
            <?php session()->forget('success'); ?>
        </script>
    @endif


    <div class="container mx-auto py-10">
        <div class="bg-white shadow-xl rounded-lg text-center p-8">
            <img src="https://vaa.edu.vn/wp-content/uploads/2024/05/vaa.svg" class="rounded-full mx-auto mb-5" height="150px"
                width="150px" alt="Profile Picture">
            <h2 class="text-2xl font-bold mb-4">{{ $sinhvien->hoten }}</h2>
            <table class="w-full">
                <tr>
                    <td class="font-semibold">Mã sinh viên:</td>
                    <td>{{ $sinhvien->mssv }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Lớp:</td>
                    <td>{{ $sinhvien->lop->tenlop }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Ngày sinh:</td>
                    <td>{{ Carbon\Carbon::parse($sinhvien->ngaysinh)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Giới Tính:</td>
                    <td>{{ $sinhvien->gioitinh }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Quê Quán:</td>
                    <td>{{ $sinhvien->quequan }}</td>
                </tr>
            </table>
            <a href="{{ route('profile.edit', ['mssv' => $sinhvien->mssv]) }}"
                class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">Chỉnh sửa</a>
        </div>
    </div>
@endsection
