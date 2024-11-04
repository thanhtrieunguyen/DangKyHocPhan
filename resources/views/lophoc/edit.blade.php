@extends('layouts.main-admin')

@section('title', 'Chỉnh Sửa Lớp học')

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
                    <h4 class="font-bold">Chỉnh sửa thông tin Lớp học</h4>
                </div>
                <div class="px-8 py-6">
                    <form action="{{ route('lophoc.update', $lop->malop) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="tenlop" class="block text-gray-700">Tên Lớp học</label>
                            <input type="text" name="tenlop"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $lop->tenlop }}" placeholder="Nhập tên Lớp học" required>
                        </div>


                        <div class="mb-4">
                            <label for="makhoa" class="block text-gray-700">Khoa:</label>
                            <select name="makhoa" id="makhoa"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Chọn khoa</option>
                                @foreach ($khoas as $khoa)
                                    <option value="{{ $khoa->makhoa }}"
                                        {{ $lop->makhoa == $khoa->makhoa ? 'selected' : '' }}>
                                        {{ $khoa->tenkhoa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
