<!DOCTYPE html>
<html>

<head>
    <title>Chỉnh Sửa Môn Học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    </style>
</head>

<body>
    @include('layouts.headeradmin')
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
                        <h4 class="font-bold">Chỉnh sửa thông tin môn học</h4>
                    </div>
                    <div class="px-8 py-6">
                        <form action="{{ route('monhoc.update', $monhoc->mamonhoc) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="mamonhoc" class="block text-gray-700">Mã Môn Học</label>
                                <input type="text" name="mamonhoc"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $monhoc->mamonhoc }}" placeholder="Nhập mã môn học" required>
                            </div>

                            <div class="mb-4">
                                <label for="tenmonhoc" class="block text-gray-700">Tên Môn Học</label>
                                <input type="text" name="tenmonhoc"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $monhoc->tenmonhoc }}" placeholder="Nhập tên môn học" required>
                            </div>

                            <div class="mb-4">
                                <label for="giangvien" class="block text-gray-700">Giảng Viên</label>
                                <input type="text" name="giangvien"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $monhoc->giangvien }}" placeholder="Nhập tên giảng viên" required>
                            </div>

                            <div class="mb-4">
                                <label for="lichhoc" class="block text-gray-700">Lịch Học</label>
                                <div class="flex items-center mb-2">
                                    <input class="mr-2" type="checkbox" id="noSchedule" name="noSchedule"
                                        {{ $monhoc->lichhoc === null ? 'checked' : '' }}>
                                    <label class="text-gray-700" for="noSchedule">Không có lịch học</label>
                                </div>
                                <div id="scheduleContainer"
                                    {{ $monhoc->lichhoc === null ? 'style=display:none;' : '' }}>

                                </div>
                                <button type="button"
                                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded"
                                    id="addScheduleRow">Thêm lịch học</button>
                            </div>

                            <input type="hidden" name="lichhoc" id="lichhocJson">

                            <div class="mb-4">
                                <label for="sotinchi" class="block text-gray-700">Số Tín Chỉ</label>
                                <input type="number" name="sotinchi"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $monhoc->sotinchi }}" placeholder="Nhập số tín chỉ" required>
                            </div>

                            <div class="mb-4">
                                <label for="soluongsinhvien" class="block text-gray-700">Số Lượng Sinh Viên</label>
                                <input type="number" name="soluongsinhvien"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $monhoc->soluongsinhvien }}" placeholder="Nhập số lượng sinh viên"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="makhoa" class="block text-gray-700">Khoa:</label>
                                <select name="makhoa" id="makhoa"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Chọn khoa</option>
                                    @foreach ($khoas as $khoa)
                                        <option value="{{ $khoa->makhoa }}"
                                            {{ $monhoc->makhoa == $khoa->makhoa ? 'selected' : '' }}>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scheduleContainer = document.getElementById('scheduleContainer');
            const addButton = document.getElementById('addScheduleRow');
            const lichhocJsonInput = document.getElementById('lichhocJson');
            const noScheduleCheckbox = document.getElementById('noSchedule');

            // Hàm để thêm hàng lịch học mới
            function addScheduleRow(day = '', startTime = '', endTime = '') {
                const row = document.createElement('div');
                row.className = 'schedule-row d-flex mb-2';
                row.innerHTML = `
            <select class="form-control mr-2" name="day">
                <option value="2" ${day === '2' ? 'selected' : ''}>Thứ 2</option>
                <option value="3" ${day === '3' ? 'selected' : ''}>Thứ 3</option>
                <option value="4" ${day === '4' ? 'selected' : ''}>Thứ 4</option>
                <option value="5" ${day === '5' ? 'selected' : ''}>Thứ 5</option>
                <option value="6" ${day === '6' ? 'selected' : ''}>Thứ 6</option>
                <option value="7" ${day === '7' ? 'selected' : ''}>Thứ 7</option>
                <option value="8" ${day === '8' ? 'selected' : ''}>Chủ nhật</option>
            </select>
            <input type="time" class="form-control mr-2" name="start_time" value="${startTime}">
            <input type="time" class="form-control mr-2" name="end_time" value="${endTime}">
            <button type="button" class="btn btn-danger remove-row">Xóa</button>
        `;
                scheduleContainer.appendChild(row);

                row.querySelector('.remove-row').addEventListener('click', function() {
                    scheduleContainer.removeChild(row);
                    updateLichhocJson();
                });

                updateLichhocJson();
            }

            // Hàm để cập nhật trường lichhocJson
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

            noScheduleCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    scheduleContainer.style.display = 'none';
                    lichhocJsonInput.value = '';
                } else {
                    scheduleContainer.style.display = 'block';
                    if (scheduleContainer.children.length === 0) {
                        addScheduleRow();
                    } else {
                        updateLichhocJson();
                    }
                }
            });

            // Thêm sự kiện lắng nghe cho nút "Thêm lịch học"
            addButton.addEventListener('click', () => addScheduleRow());

            // Thêm sự kiện lắng nghe cho các thay đổi trong scheduleContainer
            scheduleContainer.addEventListener('change', updateLichhocJson);

            // Khởi tạo lịch học hiện tại
            const currentSchedule = @json($parsedSchedule);
            if (currentSchedule.length > 0) {
                currentSchedule.forEach(schedule => {
                    addScheduleRow(schedule.day, schedule.start_time, schedule.end_time);
                });
            } else if (!noScheduleCheckbox.checked) {
                addScheduleRow(); // Thêm một hàng trống nếu không có lịch học
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@sweetalert2@10"></script>

    @include('layouts.footer')

</body>

</html>
