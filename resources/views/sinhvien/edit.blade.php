@extends('layouts.main-admin')

@section('title', 'Chỉnh sửa sinh viên')

@section('content')
<div class="container mx-auto mt-10">
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

    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="bg-blue-900 text-white text-center py-3 rounded-t-lg">
                    <h4 class="font-bold">Chỉnh sửa thông tin sinh viên</h4>
                </div>
                <div class="px-8 py-6">
                    <form method="post" action="{{ route('sinhvien.update', $sinhvien->mssv) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="updated_at" value="{{ $sinhvien->updated_at }}">

                        <div class="mb-4">
                            <label for="mssv" class="block text-gray-700 font-bold mb-2">Mã số sinh viên:</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="mssv" name="mssv"
                                value="{{ $sinhvien->mssv }}">
                        </div>
                        
                        <div class="mb-4">
                            <label for="hoten" class="block text-gray-700 font-bold mb-2">Họ tên:</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="hoten" name="hoten"
                                value="{{ $sinhvien->hoten }}">
                        </div>
                        
                        <div class="mb-4">
                            <label for="ngaysinh" class="block text-gray-700 font-bold mb-2">Ngày sinh:</label>
                            <input type="date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="ngaysinh" name="ngaysinh"
                                value="{{ $sinhvien->ngaysinh }}">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Giới tính:</label>
                            <div class="flex items-center mb-2">
                                <input class="mr-2" type="radio" id="nam" name="gioitinh" value="Nam" {{ $sinhvien->gioitinh == 'Nam' ? 'checked' : '' }}>
                                <label for="nam" class="mr-4">Nam</label>
                                <input class="mr-2" type="radio" id="nu" name="gioitinh" value="Nữ" {{ $sinhvien->gioitinh == 'Nữ' ? 'checked' : '' }}>
                                <label for="nu">Nữ</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="lop" class="block text-gray-700 font-bold mb-2">Lớp:</label>
                            <select name="lop" id="lop" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($lops as $lop)
                                    <option value="{{ $lop->malop }}" {{ $sinhvien->malop == $lop->malop ? 'selected' : '' }}>
                                        {{ $lop->tenlop }} - Khoa: {{ $lop->khoa->tenkhoa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="quequan" class="block text-gray-700 font-bold mb-2">Quê quán:</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="quequan" name="quequan"
                                value="{{ $sinhvien->quequan }}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

