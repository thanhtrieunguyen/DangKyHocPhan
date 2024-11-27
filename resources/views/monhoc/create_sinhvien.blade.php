@extends('layouts.main-admin')

@section('title', 'Thêm Sinh Viên')

@section('content')

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold">Thêm Sinh Viên Vào Môn: {{ $monhoc->tenmonhoc }}</h2>

    {{-- Form nhập MSSV --}}
    <form action="{{ route('monhoc.storeStudent', $monhoc->mamonhoc) }}" method="POST" id="addStudentForm">
        @csrf
        <div class="mb-4">
            <label for="mssv" class="block text-gray-700">Mã số sinh viên (MSSV):</label>
            <input type="text" name="mssv" id="mssv" placeholder="Nhập MSSV"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required autocomplete="off">
            @error('mssv')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hiển thị thông tin sinh viên (dùng AJAX) --}}
        <div id="studentInfo" class="hidden">
            <h3 class="text-lg font-semibold">Thông Tin Sinh Viên:</h3>
            <div class="bg-gray-100 p-4 rounded-lg">
                <p><strong>MSSV:</strong> <span id="infoMssv"></span></p>
                <p><strong>Họ tên:</strong> <span id="infoHoten"></span></p>
                <p><strong>Ngày sinh:</strong> <span id="infoNgaySinh"></span></p>
                <p><strong>Lớp:</strong> <span id="infoLop"></span></p>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" id="addButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md" disabled>
                Thêm Sinh Viên
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('mssv').addEventListener('input', async function () {
        const mssv = this.value.trim();

        if (mssv === '') {
            document.getElementById('studentInfo').classList.add('hidden');
            document.getElementById('addButton').disabled = true;
            return;
        }

        try {
            const response = await fetch(`/api/sinhvien/${mssv}`);
            if (!response.ok) throw new Error('Không tìm thấy sinh viên.');

            const sinhvien = await response.json();
            console.log(sinhvien);
            document.getElementById('infoMssv').textContent = sinhvien.mssv;
            document.getElementById('infoHoten').textContent = sinhvien.hoten;
            document.getElementById('infoNgaySinh').textContent = sinhvien.ngaysinh;
            document.getElementById('infoLop').textContent = sinhvien.lop.tenlop;

            document.getElementById('studentInfo').classList.remove('hidden');
            document.getElementById('addButton').disabled = false;
        } catch (error) {
            document.getElementById('studentInfo').classList.add('hidden');
            document.getElementById('addButton').disabled = true;
        }
    });
</script>

@endsection
