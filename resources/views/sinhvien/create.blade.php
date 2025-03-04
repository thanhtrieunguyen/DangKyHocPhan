@extends('layouts.main-admin')
@section('title', 'Thêm sinh viên')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg">
                <div class="bg-blue-900 text-white rounded-t-lg p-4 flex justify-between items-center">
                    <h2 class="font-semibold text-lg">Thêm Sinh Viên Mới</h4>
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200" href="{{ route('sinhvien.index') }}">Trở về danh sách</a>

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
    document.getElementById('makhoa').addEventListener('change', function() {
        var makhoa = this.value;
        var malopSelect = document.getElementById('malop');
        malopSelect.innerHTML = '<option value="">Chọn lớp</option>'; // Clear previous options

        if (makhoa) {
            fetch(`/getLops/${makhoa}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(lop => {
                        var option = document.createElement('option');
                        option.value = lop.malop;
                        option.text = lop.tenlop;
                        malopSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection