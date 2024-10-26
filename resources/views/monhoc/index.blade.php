<!DOCTYPE html>
<html>

<head>
    <title>Quản lý môn học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a:hover {
            text-decoration: none
        }
    </style>
</head>

<body>
    @include('layouts.headeradmin')
    <div class="container mx-auto p-4">
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

        <!-- Header section with title and button -->
        <div class="flex justify-between items-center  text-white p-4 rounded-md shadow-md"
            style="background-color: #002244">
            <h2 class="text-2xl font-semibold">Danh Sách Môn học</h2>
            <a href="{{ route('monhoc.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Thêm Môn
                học</a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-md shadow-md mt-2 p-4">
        <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-md overflow-hidden">
            <thead>
                <tr class=" text-white text-left" style="background-color: #002244">
                    <th class="py-3 px-2 text-center">STT</th>
                    <th class="py-3 px-4">Mã môn học</th>
                    <th class="py-3 px-4">Tên môn học</th>
                    <th class="py-3 px-4">Giảng viên</th>
                    <th class="py-3 px-2 text-center">Số tín chỉ</th>
                    <th class="py-3 px-4">Lịch học</th>
                    <th class="py-3 px-2">Số lượng sinh viên</th>
                    <th class="py-3 px-2">Đã đăng ký</th>
                    <th class="py-3 px-4">Khoa</th>
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
                        <td class="py-2 px-4 text-center">{{ $monhoc->soluongsinhvien }}</td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('monhoc.sinhviens', $monhoc->mamonhoc) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200">{{ $monhoc->dadangky }}</a>
                        </td>
                                
                        <td class="py-2 px-4">{{ $monhoc->khoa->tenkhoa }}</td>

                        <td class="px-4 py-2">
                            <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-all duration-200"
                                href="{{ route('monhoc.edit', $monhoc->mamonhoc) }}">Sửa</a>
                        </td>
                        <td class="px-4 py-2">
                            <form action="{{ route('monhoc.destroy', $monhoc->mamonhoc) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-all duration-200">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>


    <div class="container mx-auto mt-10">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead>
                    <tr class="bg-blue-900 text-white text-center">

                    </tr>
                </thead>
                <tbody>
                    @foreach ($monhocs as $monhoc)
                        <tr class="bg-orange-100 text-center hover:bg-orange-200 transition-all duration-200">


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')

</body>


</html>
