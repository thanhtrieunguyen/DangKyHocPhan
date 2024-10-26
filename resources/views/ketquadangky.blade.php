<!DOCTYPE html>
<html>

<head>
    <title>Kết quả đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.6.0-web/css/all.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        td a {
            text-decoration: none;
            color: #002244
        }

        th,
        td {
            height: 50px;
            /* Đặt chiều cao cho các ô */
            text-align: center;
            /* Căn giữa nội dung trong ô */
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <div class="container mx-auto py-12">
        <!-- Title -->
        <div class="text-center text-2xl font-bold text-black mb-6">
            KẾT QUẢ ĐĂNG KÝ HỌC PHẦN
        </div>

        <!-- Student Info -->
        <div class="text-center mb-6">
            <p class="text-lg">Họ tên: <strong>{{ $sinhvien->hoten }}</strong></p>
            <p class="text-lg">Mã Sinh Viên: <strong>{{ $sinhvien->mssv }}</strong> - Lớp:
                <strong>{{ $sinhvien->lop->tenlop }}</strong></p>
        </div>

        <!-- Course Registration List Title -->
        <div class="text-center text-xl font-semibold text-blue-800 mb-8">
            Danh sách học phần đã đăng ký
        </div>

        <!-- Registered Courses Table -->
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
                        <th class="py-2 px-4">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dsDangKy as $index => $dangky)
                        <tr class="text-center border-t bg-orange-100">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $dangky->mamonhoc }}</td>
                            <td class="py-2 px-4">{{ $dangky->dstenmonhoc }}</td>
                            <td class="py-2 px-4">{{ $dangky->dsgiangvien }}</td>
                            <td class="py-2 px-4">{{ $dangky->dssotinchi }}</td>
                            <td class="py-2 px-4">{{ $dangky->monhoc->lichhoc }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('delete_dangky', ['mamonhoc' => $dangky->mamonhoc]) }}"
                                    class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @include('layouts.footer')
</body>


</html>
