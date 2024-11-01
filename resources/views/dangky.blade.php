@extends('layouts.main')

@section('title', 'Đăng ký học phần')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <!-- Error Notification -->
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

        <!-- Title and Student Info -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold mb-4">Đăng Ký Học Phần</h1>
            <p class="text-lg">Họ tên: <strong>{{ $sinhvien->hoten }}</strong></p>
            <p class="text-lg">Mã Sinh Viên: <strong>{{ $sinhvien->masinhvien }}</strong> - Lớp:
                <strong>{{ $sinhvien->lop->tenlop }}</strong>
            </p>
        </div>

        <!-- Search Section -->
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold mb-4">Danh Sách Học Phần - Khoa: <span
                    class="text-blue-600">{{ $sinhvien->lop->khoa->tenkhoa }}</span></h2>
            <form class="inline-block" action="{{ route('dangky.search') }}" method="post">
                @csrf
                <div class="flex items-center space-x-4">
                    <input class="border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" type="text"
                        name="search" placeholder="Tìm kiếm...">
                    <input type="submit"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg cursor-pointer hover:bg-blue-600 transition"
                        value="Tìm kiếm">
                </div>
            </form>
        </div>

        <!-- Course List -->
        <div class="overflow-x-auto mx-auto max-w-screen-lg">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="text-white" style="background-color: #002244">
                    <tr>
                        <th class="py-2 px-4">STT</th>
                        <th class="py-2 px-4">Mã Môn Học</th>
                        <th class="py-2 px-4">Môn Học</th>
                        <th class="py-2 px-4">Giảng Viên</th>
                        <th class="py-2 px-4">Số Tín Chỉ</th>
                        <th class="py-2 px-4">Lịch Học</th>
                        <th class="py-2 px-4">Số Lượng Sinh Viên</th>
                        <th class="py-2 px-4">Đăng Ký</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monHocList as $index => $monhoc)
                        <tr class="text-center border-t">
                            <td class="py-2 px-2">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $monhoc->mamonhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->tenmonhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->giangvien }}</td>
                            <td class="py-2 px-2">{{ $monhoc->sotinchi }}</td>
                            <td class="py-2 px-4">{{ $monhoc->lichhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->dadangky }} / {{ $monhoc->soluongsinhvien }}</td>
                            <td class="py-2 px-4"
                                style="background: {{ $monhoc->dadangky < $monhoc->soluongsinhvien ? '' : '#ff0000' }};">
                                @if ($monhoc->dadangky < $monhoc->soluongsinhvien)
                                    <button
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg transition-all duration-200 cursor-pointer btn-register"
                                        data-mamonhoc="{{ $monhoc->mamonhoc }}" style="text-decoration: none">Đăng
                                        ký</button>
                                @else
                                    Hết chỗ
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- jQuery and Ajax for Registration -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.btn-register').click(function() {
                    var mamonhoc = $(this).data('mamonhoc');
                    $.ajax({
                        url: '{{ route('dangkyhocphan.add') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            mamonhoc: mamonhoc
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Có lỗi xảy ra!',
                                text: xhr.responseJSON.message,
                                showConfirmButton: true,
                            });
                        }
                    });
                });
            });
        </script>

    </div>
@endsection
