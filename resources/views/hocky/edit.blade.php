@extends('layouts.main-admin')

@section('title', 'Chỉnh Sửa Học kỳ')

@section('content')
    <div class="container mx-auto mt-10 mb-14">
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
                        <h4 class="font-bold">Chỉnh sửa thông tin Học kỳ</h4>
                    </div>
                    <div class="px-8 py-6">
                        <form action="{{ route('hocky.update', $hocky->mahocky) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="mahocky" class="block text-gray-700">Mã Học kỳ</label>
                                <input type="text" name="mahocky"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $hocky->mahocky }}" placeholder="Nhập mã Học kỳ" required>
                            </div>

                            <div class="mb-4">
                                <label for="tenhocky" class="block text-gray-700">Tên Học kỳ</label>
                                <input type="text" name="tenhocky"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $hocky->tenhocky }}" placeholder="Nhập tên Học kỳ" required>
                            </div>

                            @php
                                $currentYear = date('Y'); // Năm hiện tại
                                $years = [
                                    $currentYear - 1, // Năm ngoái
                                    $currentYear, // Năm hiện tại
                                    $currentYear + 1, // Năm tiếp theo
                                    $currentYear + 2, // 2 năm tiếp theo
                                    $currentYear + 3, // 3 năm tiếp theo
                                ];
                            @endphp

                            <div class="mb-4">
                                <label for="namhoc" class="block text-gray-700 font-bold mb-2">Năm học:</label>
                                <select name="namhoc"
                                    class="form-input mt-1 block border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring focus:ring-blue-300">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                            {{ old('namhoc', $hocky->namhoc) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-4">
                                <label for="ngaybatdau" class="block text-gray-700 font-bold mb-2">Ngày bắt đầu:</label>
                                <input type="date"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="ngaybatdau" name="ngaybatdau" value="{{ $hocky->ngaybatdau }}">
                            </div>

                            <div class="mb-4">
                                <label for="ngayketthuc" class="block text-gray-700 font-bold mb-2">Ngày kết thúc:</label>
                                <input type="date"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="ngayketthuc" name="ngayketthuc" value="{{ $hocky->ngayketthuc }}">
                            </div>

                            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded">Cập
                                Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
