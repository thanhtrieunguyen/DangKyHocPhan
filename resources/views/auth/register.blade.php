<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

    
        .hd-logo .logo-txt {
            font-size: 1.85rem;
            color: #B3995D;
            font-weight: 600;
            line-height: 130%;
            text-transform: uppercase;
        }

    </style>
    <title>Trang đăng ký</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
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

        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">
            <div class="flex items-center mb-6">
                <a href="#" class="mr-2">
                    <img src="https://vaa.edu.vn/wp-content/uploads/2024/05/vaa.svg" alt="Logo" class="w-20 h-20">
                </a>
                <span class="text-lg font-bold " style="color: #B3995D">
                    HỌC VIỆN HÀNG KHÔNG VIỆT NAM<br>VIETNAM AVIATION ACADEMY
                </span>
            </div>

            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Đăng ký</h2>

            @if (session('error'))
                <div class="text-red-500 text-center mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">MSSV:</label>
                    <input
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="mssv" placeholder="Nhập MSSV" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Mật khẩu:</label>
                    <input
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Họ tên:</label>
                    <input
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="hoten" placeholder="Nhập họ tên" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Ngày sinh:</label>
                    <input
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        type="date" name="ngaysinh" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Giới tính:</label>
                    <select
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        name="gioitinh" required>
                        <option value="">Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Mã khoa:</label>
                    <select
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        name="makhoa" id="makhoa" required>
                        <option value="">Chọn khoa</option>
                        @foreach ($khoas as $khoa)
                            <option value="{{ $khoa->makhoa }}">{{ $khoa->tenkhoa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Mã lớp:</label>
                    <select
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        name="malop" id="malop" required>
                        <option value="">Chọn lớp</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Quê quán:</label>
                    <input
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="quequan" placeholder="Nhập quê quán" required>
                </div>

                <div class="text-center">
                    <input type="submit"
                        class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200 cursor-pointer"
                        name="dangky" value="Đăng ký">
                </div>

                <div class="text-center mt-4">
                    <span>Bạn đã có tài khoản? </span>
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đăng nhập ngay!</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Sử dụng Ajax để lấy danh sách lớp khi chọn khoa
        $('#makhoa').on('change', function() {
            var makhoa = $(this).val();
            if (makhoa) {
                $.ajax({
                    url: '/getLops/' + makhoa,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#malop').empty();
                        $('#malop').append('<option value="">Chọn lớp</option>');
                        $.each(data, function(key, value) {
                            $('#malop').append('<option value="' + value.malop + '">' + value
                                .tenlop + '</option>');
                        });
                    }
                });
            } else {
                $('#malop').empty();
                $('#malop').append('<option value="">Chọn lớp</option>');
            }
        });
    </script>
</body>


</html>
