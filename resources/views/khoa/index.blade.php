@extends('layouts.main-admin')

@section('title', 'Danh sách khoa')
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

    <style>
        td {
            height: 60px;
        }
    </style>

    <div class="container mx-auto p-4">

        <!-- Header section with title and button -->
        <div class="flex justify-between items-center  text-white p-4 rounded-md shadow-md" style="background-color: #002244">
            <h2 class="text-2xl font-semibold">Danh Sách Khoa</h2>
            <a href="{{ route('khoa.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Thêm mới Khoa</a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-md shadow-md mt-2 p-4">
            <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-md overflow-hidden">
                <thead>
                    <tr class="text-white text-left" style="background-color: #002244">
                        <th class="py-3 px-2 text-center">STT</th>
                        <th class="py-3 px-4">Mã khoa</th>
                        <th class="py-3 px-4">Tên khoa</th>
                        <th class="py-3 px-4 text-center">Số lớp</th>
                        <th class="py-3 px-4 text-center">Sửa</th>
                        <th class="py-3 px-4 text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($khoas as $index => $khoa)
                        <tr class="border-b border-gray-200 hover:bg-yellow-100 transition-all duration-200">
                            <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 text-center">{{ $khoa->makhoa }}</td>
                            <td class="py-2 px-4">{{ $khoa->tenkhoa }}</td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('khoa.lophocs', $khoa->makhoa) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200">
                                    {{ $khoa->lops_count }}
                                </a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                    href="{{ route('khoa.edit', $khoa->makhoa) }}">Sửa</a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                    onclick="confirmDelete('{{ route('khoa.destroy', $khoa->makhoa) }}')">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="container mx-auto mt-10">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-blue-900 text-white text-center">

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($khoas as $khoa)
                            <tr class="bg-orange-100 text-center hover:bg-orange-200 transition-all duration-200">


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4 -mt-4">
                    {{ $khoas->links() }}
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Hành động này sẽ xóa khoa!",
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
