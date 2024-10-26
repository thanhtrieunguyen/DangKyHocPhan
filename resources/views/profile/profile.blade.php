<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        td {
            height: 50px;
            text-align: center;
            font-size: 18px
        }
        
    </style>

    <title>Thông tin sinh viên</title>
</head>
<body>
    @include('layouts.header');

    <div class="container mx-auto py-10">
        <div class="bg-white shadow-xl rounded-lg text-center p-8">
            <img src="https://vaa.edu.vn/wp-content/uploads/2024/05/vaa.svg" class="rounded-full mx-auto mb-5" height="150px" width="150px" alt="Profile Picture">
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
            <a href="{{ route('profile.edit', ['mssv' => $sinhvien->mssv]) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">Chỉnh sửa</a>
        </div>
    </div>

    @include('layouts.footer')
</body>



</html>
