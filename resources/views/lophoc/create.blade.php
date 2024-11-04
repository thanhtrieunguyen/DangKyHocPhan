@extends('layouts.main-admin')

@section('title', 'Thêm Lớp học')

@section('content')
<div class="container mx-auto mt-5 mb-14">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-900 text-white rounded-t-lg p-4 flex justify-between items-center">
            <h2 class="font-semibold text-lg">Thêm Lớp học</h2>
            <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200" href="{{ route('lophoc.index') }}">Trở về danh sách</a>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong>Oh!</strong> Đã có lỗi xảy ra.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('lophoc.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="tenlop" class="block text-gray-700">Tên Lớp Học</label>
                    <input type="text" name="tenlop" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập tên môn học">
                </div>

                <div class="mb-4">
                    <label for="makhoa" class="block text-gray-700">Khoa:</label>
                    <select name="makhoa" id="makhoa" class="form-select mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">Chọn khoa</option>
                        @foreach ($khoas as $khoa)
                            <option value="{{ $khoa->makhoa }}">{{ $khoa->tenkhoa }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-all duration-200">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection