@extends('layouts.main')

@section('title', 'Kết quả đăng ký')

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


    <div class="container mx-auto py-12">

        <!-- Title and Student Info -->
        <div class="text-center mb-8 grid grid-cols-3 gap-4 items-center">
            <h1 class="text-3xl font-semibold col-span-3">KẾT QUẢ ĐĂNG KÝ HỌC PHẦN</h1>
            <p class="text-lg">Họ tên: <strong>{{ $sinhvien->hoten }}</strong></p>
            <p class="text-lg">Mã Sinh Viên: <strong>{{ $sinhvien->mssv }}</strong></p>
            <p class="text-lg">Lớp: <strong>{{ $sinhvien->lop->tenlop }}</strong></p>
        </div>

        <!-- Course Registration List Title -->
        <div class="text-center text-xl font-semibold text-blue-800 mb-8">
            Danh sách học phần đã đăng ký
        </div>

        <!-- Registered Courses Table -->
        <div class="bg-white rounded-md shadow-md mt-2 p-4">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg ">
                <thead>
                    <tr class="text-white text-left" style="background-color: #002244">
                        <th class="py-2 px-4">STT</th>
                        <th class="py-2 px-4">Mã Môn Học</th>
                        <th class="py-2 px-4">Môn Học</th>
                        <th class="py-2 px-4">Giảng Viên</th>
                        <th class="py-2 px-4">Số Tín Chỉ</th>
                        <th class="py-2 px-4">Lịch Học</th>
                        <th class="py-2 px-4">Hành Động</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($dsDangKy as $index => $dangky)
                        <tr class="border-b border-gray-200 hover:bg-yellow-100 transition-all duration-200">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $dangky->mamonhoc }}</td>
                            <td class="py-2 px-4">{{ $dangky->dstenmonhoc }}</td>
                            <td class="py-2 px-4">{{ $dangky->dsgiangvien }}</td>
                            <td class="py-2 px-4">{{ $dangky->dssotinchi }}</td>
                            <td class="py-2 px-4">{{ $dangky->monhoc->lichhoc }}</td>
                            <td class="py-2 px-4">
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                    onclick="confirmDelete('{{ route('delete_dangky', ['mamonhoc' => $dangky->mamonhoc]) }}')">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
