<?php

namespace Tests\Feature;

use App\Models\SinhVien;
use App\Models\MonHoc;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TransactionConcurrencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_concurrent_registration()
    {
        $monHoc = MonHoc::create([
            'mamonhoc' => 'CNTT111',
            'tenmonhoc' => 'Trí tuệ nhân tạo',
            'giangvien' => 'Nguyễn Hữu Nghĩa',
            'sotinchi' => 3,
            'soluongsinhvien' => 50,
            'dadangky' => 49,
            'makhoa' => 'CNTT',
        ]);

        // Tạo 3 sinh viên
        $sinhVien1 = SinhVien::create([
            'mssv' => 'SV001',
            'password' => bcrypt('123456'), // Mật khẩu mã hóa
            'hoten' => 'Nguyen Van A',
            'ngaysinh' => '2000-01-01',
            'gioitinh' => 'Nam',
            'malop' => 'CB02',
            'makhoa' => 'CB',
            'quequan' => 'Ha Noi'
        ]);

        $sinhVien2 = SinhVien::create([
            'mssv' => 'SV002',
            'password' => bcrypt('123456'),
            'hoten' => 'Tran Thi B',
            'ngaysinh' => '2000-02-02',
            'gioitinh' => 'Nu',
            'malop' => 'CB02',
            'makhoa' => 'CB',
            'quequan' => 'Da Nang'
        ]);

        $sinhVien3 = SinhVien::create([
            'mssv' => 'SV003',
            'password' => bcrypt('123456'),
            'hoten' => 'Le Van C',
            'ngaysinh' => '2000-03-03',
            'gioitinh' => 'Nam',
            'malop' => 'CB02',
            'makhoa' => 'CB',
            'quequan' => 'Hai Phong'
        ]);


        // Khởi chạy 3 request đồng thời để đăng ký môn học
        $responses = [];
        foreach ([$sinhVien1, $sinhVien2, $sinhVien3] as $sinhVien) {
            $responses[] = $this->post('/dangky/addMonHoc/' . $monHoc->mamonhoc, ['mssv' => $sinhVien->mssv]);
        }

        // Kiểm tra phản hồi và số lượng đăng ký
        foreach ($responses as $response) {
            $response->assertSessionHas('success');
        }

        // Kiểm tra số lượng đã đăng ký trong database
        $this->assertDatabaseHas('monhoc', [
            'mamonhoc' => 'CNTT111',
            'dadangky' => 50, // Kiểm tra xem số lượng đã cập nhật đúng
        ]);
    }
}
