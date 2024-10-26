<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            padding-bottom: 100px
        }
    </style>
</head>

<body>
    @include('layouts.headeradmin');
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white shadow-lg rounded-lg">
                    <div class="bg-blue-900 text-white text-center py-3 rounded-t-lg">
                        <h4 class="font-bold">Thêm Sinh Viên Mới</h4>
                    </div>
                    <div class="px-8 py-6">
                        <form action="{{ route('sinhvien.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="mssv" class="block text-gray-700 font-bold mb-2">Mã số sinh
                                    viên:</label>
                                <input type="text" name="mssv" id="mssv"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('mssv') }}">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 font-bold mb-2">Mật khẩu:</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="hoten" class="block text-gray-700 font-bold mb-2">Họ tên:</label>
                                <input type="text" name="hoten" id="hoten"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('hoten') }}">
                            </div>

                            <div class="mb-4">
                                <label for="ngaysinh" class="block text-gray-700 font-bold mb-2">Ngày sinh:</label>
                                <input type="date" name="ngaysinh" id="ngaysinh"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('ngaysinh') }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Giới tính:</label>
                                <div class="flex items-center">
                                    <input type="radio" name="gioitinh" value="Nam" id="nam" class="mr-2">
                                    <label for="nam" class="mr-4">Nam</label>
                                    <input type="radio" name="gioitinh" value="Nữ" id="nu" class="mr-2">
                                    <label for="nu">Nữ</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="makhoa" class="block text-gray-700 font-bold mb-2">Khoa:</label>
                                <select name="makhoa" id="makhoa"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Chọn khoa</option>
                                    @foreach ($khoas as $khoa)
                                        <option value="{{ $khoa->makhoa }}">{{ $khoa->tenkhoa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="malop" class="block text-gray-700 font-bold mb-2">Lớp:</label>
                                <select name="malop" id="malop"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Chọn lớp</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="quequan" class="block text-gray-700 font-bold mb-2">Quê quán:</label>
                                <input type="text" name="quequan" id="quequan"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('quequan') }}">
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">Thêm
                                    Sinh Viên</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
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

    @include('layouts.footer')

</body>

</html>
