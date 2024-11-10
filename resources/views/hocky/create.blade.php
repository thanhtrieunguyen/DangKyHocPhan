@extends('layouts.main-admin')

@section('title', 'Thêm mới Học kỳ')

@section('content')
    <div class="container mx-auto mt-5 mb-14">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-blue-900 text-white rounded-t-lg p-4 flex justify-between items-center">
                <h2 class="font-semibold text-lg">Thêm mới Học kỳ</h2>
                <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200"
                    href="{{ route('hocky.index') }}">Trở về danh sách</a>
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

                <form action="{{ route('hocky.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="mahocky" class="block text-gray-700 font-bold mb-2">Mã Học kỳ</label>
                        <input type="text" name="mahocky"
                            class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300"
                            placeholder="Nhập mã học kỳ">
                    </div>

                    <div class="mb-4">
                        <label for="tenhocky" class="block text-gray-700 font-bold mb-2">Tên Học kỳ</label>
                        <input type="text" name="tenhocky"
                            class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300"
                            placeholder="Nhập tên học kỳ">
                    </div>

                    @php
                        $currentYear = date('Y');
                        $years = [$currentYear - 1, $currentYear, $currentYear + 1, $currentYear + 2];
                    @endphp


                    <div class="mb-4">
                        <label for="namhoc" class="block text-gray-700 font-bold mb-2">Năm học</label>
                        <select name="namhoc"
                            class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300">
                            @foreach ($years as $year)
                                <option value="{{ $year }}"
                                    {{ old('namhoc', $currentYear) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-4">
                        <label for="ngaybatdau" class="block text-gray-700 font-bold mb-2">Ngày bắt đầu:</label>
                        <input type="date" name="ngaybatdau" id="ngaybatdau"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('ngaybatdau') }}">
                    </div>

                    <div class="mb-4">
                        <label for="ngayketthuc" class="block text-gray-700 font-bold mb-2">Ngày kết thúc:</label>
                        <input type="date" name="ngayketthuc" id="ngayketthuc"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('ngayketthuc') }}">
                    </div>

                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-all duration-200">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Hàm để tính toán ngày kết thúc là cuối tháng sau 3 tháng
        function setEndDate() {
            var startDate = document.getElementById('ngaybatdau').value;
            if (startDate) {
                var start = new Date(startDate);
                start.setMonth(start.getMonth() + 3); // Cộng 3 tháng

                // Lấy ngày cuối cùng của tháng mới
                var lastDay = new Date(start.getFullYear(), start.getMonth() + 1, 0);

                // Đặt ngày kết thúc vào ô input
                var endDate = lastDay.toISOString().split('T')[0];
                document.getElementById('ngayketthuc').value = endDate;
            }
        }

        // Lắng nghe sự kiện thay đổi của ngày bắt đầu
        document.getElementById('ngaybatdau').addEventListener('change', setEndDate);

        // Gọi hàm khi trang tải để set ngày kết thúc nếu đã có giá trị ngày bắt đầu
        window.onload = setEndDate;
    </script>

@endsection
