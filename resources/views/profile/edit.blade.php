@extends('layouts.main')

@section('title', 'Chỉnh sửa thông tin sinh viên')

@section('content')
    <div class="container mx-auto py-10">
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

        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Chỉnh sửa thông tin sinh viên</h2>

            <form action="{{ route('transaction.update', ['mssv' => $sinhvien->mssv]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="updated_at" value="{{ $sinhvien->updated_at }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="hoten">Họ tên:</label>
                    <input
                        class="input99 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="hoten" id="hoten" value="{{ $sinhvien->hoten }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="ngaysinh">Ngày sinh:</label>
                    <input
                        class="input99 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
                        type="date" name="ngaysinh" id="ngaysinh" value="{{ $sinhvien->ngaysinh }}" required>
                </div>

                <div class="mb-4">
                    <span class="block text-gray-700 font-medium mb-2">Giới Tính:</span>
                    <div class="flex items-center">
                        <label class="mr-4">
                            <input type="radio" name="gioitinh" value="Nam"
                                {{ $sinhvien->gioitinh == 'Nam' ? 'checked' : '' }}> Nam
                        </label>
                        <label>
                            <input type="radio" name="gioitinh" value="Nữ"
                                {{ $sinhvien->gioitinh == 'Nữ' ? 'checked' : '' }}> Nữ
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="lop" class="block text-gray-700 font-bold mb-2">Lớp:</label> 
                    <select disabled id="lop" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-not-allowed">
                        @foreach ($lops as $lop)
                            <option value="{{ $lop->malop }}" {{ $sinhvien->malop == $lop->malop ? 'selected' : '' }}>
                                {{ $lop->tenlop }} - Khoa: {{ $lop->tenkhoa }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Trường input hidden để gửi giá trị lớp đã chọn -->
                    <input type="hidden" name="lop" value="{{ $sinhvien->malop }}">
                </div>
                

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="quequan">Quê quán:</label>
                    <input
                        class="input99 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
                        type="text" name="quequan" id="quequan" value="{{ $sinhvien->quequan }}" required>
                </div>

                <div class="flex justify-center">
                    <input type="submit"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-300"
                        name="update" value="Cập nhật">
                </div>
            </form>
        </div>
    </div>
@endsection
