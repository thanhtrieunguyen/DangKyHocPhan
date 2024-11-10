@extends('layouts.main-admin')

@section('title', 'Danh sách môn học')
@section('content')
    <!-- Success Notification -->
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

    <div class="container mx-auto p-4 min-w-full">

        <!-- Header section with title and button -->
        <div class="flex justify-between items-center  text-white p-4 rounded-md shadow-md" style="background-color: #002244">
            <h2 class="text-2xl font-semibold">Danh Sách Môn học</h2>
            <a href="{{ route('monhoc.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Thêm Môn
                học</a>
        </div>

        <form method="GET" action="{{ route('monhoc.index') }}" class="mt-4">
            <div class="flex items-center">
                <label for="makhoa" class="mr-2 text-white">Chọn Khoa:</label>
                <select name="makhoa" id="makhoa" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach ($khoas as $khoa)
                        <option value="{{ $khoa->makhoa }}" {{ request('makhoa') == $khoa->makhoa ? 'selected' : '' }}>
                            {{ $khoa->tenkhoa }}
                        </option>
                    @endforeach
                </select>

                <label for="hocky" class="ml-4 mr-2 text-white">Chọn Học Kỳ:</label>
                <select name="hocky" id="hocky" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach ($hockys as $hocky)
                        <option value="{{ $hocky->mahocky }}" {{ request('hocky') == $hocky->mahocky ? 'selected' : '' }}>
                            {{ $hocky->tenhocky }} - Năm học: {{ $hocky->namhoc }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="ml-2 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Lọc</button>
            </div>
        </form>

        <!-- Table Section -->
        <div class="bg-white rounded-md shadow-md mt-2 p-4">
            <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-md overflow-hidden">
                <thead>
                    <tr class="text-white text-left" style="background-color: #002244">
                        <th class="py-3 px-2 text-center">STT</th>
                        <th class="py-3 px-4">Mã MH</th>
                        <th class="py-3 px-4">Tên môn học</th>
                        <th class="py-3 px-4">Giảng viên</th>
                        <th class="py-3 px-2 text-center">TC</th>
                        <th class="py-3 px-4">Lịch học</th>
                        <th class="py-3 px-2">Số lượng</th>
                        <th class="py-3 px-2">Đã đăng ký</th>
                        <th class="py-3 px-4">Khoa</th>
                        <th class="py-3 px-4">Học kỳ</th>
                        <th class="py-3 px-4 text-center">Sửa</th>
                        <th class="py-3 px-4 text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($monhocs as $index => $monhoc)
                        <tr class="border-b border-gray-200 hover:bg-yellow-100 transition-all duration-200">
                            <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 text-center">{{ $monhoc->mamonhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->tenmonhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->giangvien }}</td>
                            <td class="py-2 px-4 text-center">{{ $monhoc->sotinchi }}</td>
                            <td class="py-2 px-4">{{ $monhoc->lichhoc }}</td>
                            <td class="py-2 px-4">{{ $monhoc->soluongsinhvien }}</td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('monhoc.sinhviens', $monhoc->mamonhoc) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200">{{ $monhoc->dadangky }}</a>
                            </td>

                            <td class="py-2 px-4">{{ $monhoc->khoa->tenkhoa }}</td>
                            <td class="py-2 px-4">{{ $monhoc->mahocky }}</td>

                            <td class="px-4 py-2">
                                <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                    href="{{ route('monhoc.edit', $monhoc->mamonhoc) }}">Sửa</a>
                            </td>

                            {{-- <td class="px-4 py-2">
                            <form action="{{ route('monhoc.destroy', $monhoc->mamonhoc) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-all duration-200">Xóa</button>
                            </form>
                        </td> --}}

                            <td class="px-4 py-2">
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                    onclick="confirmDelete('{{ route('monhoc.destroy', $monhoc->mamonhoc) }}')">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="my-4 -mt-4">
                {{ $monhocs->links() }}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Hành động này sẽ xóa môn học!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Không, hủy bỏ!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu xác nhận, gửi yêu cầu xóa
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}'; // Thay thế với token của bạn

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
