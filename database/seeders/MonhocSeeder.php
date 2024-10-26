<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonhocSeeder extends Seeder
{
    public function run()
    {
        DB::table('monhoc')->insert([
            ['mamonhoc' => 'CNTT01', 'tenmonhoc' => 'Lập trình C++', 'giangvien' => 'ThS. Thái Duy Quý', 'lichhoc' => 'Thứ 2, 14h00-16h00', 'sotinchi' => 3, 'soluongsinhvien' => 50, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT02', 'tenmonhoc' => 'Lập trình Java', 'giangvien' => 'ThS. Lê Gia Công', 'lichhoc' => 'Thứ 3, 09h00-11h00', 'sotinchi' => 4, 'soluongsinhvien' => 45, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT03', 'tenmonhoc' => 'Phát triển ứng dụng di động', 'giangvien' => 'ThS. Lê Văn Tài', 'lichhoc' => 'Thứ 4, 12h00-15h00', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT04', 'tenmonhoc' => 'Mạng máy tính', 'giangvien' => 'ThS. Huỳnh Thanh Sơn', 'lichhoc' => 'Thứ 7, 07h00-12h00', 'sotinchi' => 4, 'soluongsinhvien' => 45, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT05', 'tenmonhoc' => 'Hệ quản trị cơ sở dữ liệu', 'giangvien' => 'TS. Nguyễn Lương Anh Tuấn', 'lichhoc' => 'Thứ 5, 12h00-15h00', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT06', 'tenmonhoc' => 'Lập trình mạng', 'giangvien' => 'ThS. Ngô Minh Nhựt', 'lichhoc' => 'Thứ 3, 16h00-20h00', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT07', 'tenmonhoc' => 'Hệ điều hành', 'giangvien' => 'ThS. Nguyễn Hữu Hiệp', 'lichhoc' => 'Thứ 4, 07h00-10h30', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'CNTT08', 'tenmonhoc' => 'Lập trình Python', 'giangvien' => 'ThS. Hồ Văn Quí', 'lichhoc' => 'Thứ 5, 07h00-10h30', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT'],
            ['mamonhoc' => 'MKT01', 'tenmonhoc' => 'Xác xuất thống kê', 'giangvien' => 'TS. Trịnh Xuân Quyết', 'lichhoc' => 'Thứ 2, 07h00-10h30', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'KT'],
            ['mamonhoc' => 'MKT02', 'tenmonhoc' => 'Marketing cơ bản', 'giangvien' => 'ThS. Lê Thị Tươi', 'lichhoc' => 'Thứ 3, 07h00-10h30', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'KT'],
            ['mamonhoc' => 'MCB01', 'tenmonhoc' => 'Pháp luật đại cương', 'giangvien' => 'ThS. Nguyễn Tuấn Anh', 'lichhoc' => 'Thứ 6, 12h00-16h30', 'sotinchi' => 3, 'soluongsinhvien' => 60, 'makhoa' => 'CB'],
            ['mamonhoc' => 'MCB02', 'tenmonhoc' => 'Triết học', 'giangvien' => 'ThS. Lê Thị Hoa', 'lichhoc' => 'Thứ 3, 16h00-20h00', 'sotinchi' => 3, 'soluongsinhvien' => 60, 'makhoa' => 'CB'],
        
        ]);
    }
}
