@extends('layouts.main-admin')

@section('title', 'Thêm Môn Học')

@section('content')
<div class="container mx-auto mt-5 mb-14">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-900 text-white rounded-t-lg p-4 flex justify-between items-center">
            <h2 class="font-semibold text-lg">Thêm Môn Học</h2>
            <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200" href="{{ route('monhoc.index') }}">Trở về danh sách</a>
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

            <form action="{{ route('monhoc.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="mamonhoc" class="block text-gray-700">Mã Môn Học</label>
                    <input type="text" name="mamonhoc" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập mã môn học">
                </div>

                <div class="mb-4">
                    <label for="tenmonhoc" class="block text-gray-700">Tên Môn Học</label>
                    <input type="text" name="tenmonhoc" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập tên môn học">
                </div>

                <div class="mb-4">
                    <label for="giangvien" class="block text-gray-700">Giảng Viên</label>
                    <input type="text" name="giangvien" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập tên giảng viên">
                </div>

                <div class="mb-4">
                    <label for="lichhoc" class="block text-gray-700">Lịch Học</label>
                    <div id="scheduleContainer">
                        <!-- Các hàng lịch học sẽ được thêm vào đây bằng JavaScript -->
                    </div>
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mt-2" id="addScheduleRow">Thêm lịch học</button>
                </div>

                <input type="hidden" name="lichhoc" id="lichhocJson">

                <div class="mb-4">
                    <label for="sotinchi" class="block text-gray-700">Số Tín Chỉ</label>
                    <input type="number" name="sotinchi" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập số tín chỉ">
                </div>

                <div class="mb-4">
                    <label for="soluongsinhvien" class="block text-gray-700">Số Lượng Sinh Viên</label>
                    <input type="number" name="soluongsinhvien" class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Nhập số lượng sinh viên">
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

                <div class="mb-4">
                    <label for="mahocky" class="block text-gray-700">Học kỳ:</label>
                    <select name="mahocky" id="mahocky" class="form-select mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">Chọn học kỳ</option>
                        @foreach ($hockys as $hocky)
                            <option value="{{ $hocky->mahocky }}">{{ $hocky->tenhocky }} - Năm học {{ $hocky->namhoc }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-all duration-200">Lưu</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleContainer = document.getElementById('scheduleContainer');
        const addButton = document.getElementById('addScheduleRow');
        const lichhocJsonInput = document.getElementById('lichhocJson');

        addButton.addEventListener('click', addScheduleRow);

        function addScheduleRow() {
            const row = document.createElement('div');
            row.className = 'schedule-row mb-2 flex items-center';
            row.innerHTML = `
                <select class="form-select mt-1 block mr-2" name="day">
                    <option value="2">Thứ 2</option>
                    <option value="3">Thứ 3</option>
                    <option value="4">Thứ 4</option>
                    <option value="5">Thứ 5</option>
                    <option value="6">Thứ 6</option>
                    <option value="7">Thứ 7</option>
                </select>
                <input type="time" class="form-input mt-1 block mr-2" name="start_time">
                <input type="time" class="form-input mt-1 block mr-2" name="end_time">
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded remove-row">Xóa</button>
            `;
            scheduleContainer.appendChild(row);

            row.querySelector('.remove-row').addEventListener('click', function() {
                scheduleContainer.removeChild(row);
                updateLichhocJson();
            });

            updateLichhocJson();
        }

        function updateLichhocJson() {
            const rows = scheduleContainer.querySelectorAll('.schedule-row');
            const scheduleData = Array.from(rows).map(row => {
                return {
                    day: row.querySelector('[name="day"]').value,
                    start_time: row.querySelector('[name="start_time"]').value,
                    end_time: row.querySelector('[name="end_time"]').value
                };
            });
            lichhocJsonInput.value = JSON.stringify(scheduleData);
        }

        scheduleContainer.addEventListener('change', updateLichhocJson);

        // Thêm một hàng lịch học mặc định
        addScheduleRow();
    });
</script>
@endsection