<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SinhvienSeeder extends Seeder
{
    public function run()
    {
        DB::table('sinhvien')->insert([
            ['mssv' => '2254810263', 'password' => bcrypt('123456'), 'hoten' => 'Nguyễn Thanh Triều', 'ngaysinh' => '2004-05-07', 'gioitinh' => 'Nam', 'lop' => 'TT01', 'quequan' => 'Ha Noi'],
            ['mssv' => '2254800000', 'password' => bcrypt('123456'), 'hoten' => 'Dương Ngô Vân Anh', 'ngaysinh' => '2004-07-25', 'gioitinh' => 'Nữ', 'lop' => 'KT01', 'quequan' => 'Ha Noi'],
            ['mssv' => '2254800267', 'password' => bcrypt('123456'), 'hoten' => 'Tân Mỹ Quân', 'ngaysinh' => '2004-01-07', 'gioitinh' => 'Nữ', 'lop' => 'TT01', 'quequan' => 'Ha Noi'],
            ['mssv' => '2254810287', 'password' => bcrypt('123456'), 'hoten' => 'Nguyễn Trần Chí Trung', 'ngaysinh' => '2004-08-03', 'gioitinh' => 'Nam', 'lop' => 'IT02', 'quequan' => 'Ho Chi Minh'],
            ['mssv' => '2254810303', 'password' => bcrypt('123456'), 'hoten' => 'Nguyễn Ngọc Vinh', 'ngaysinh' => '2004-03-03', 'gioitinh' => 'Nam', 'lop' => 'IT02', 'quequan' => 'Ho Chi Minh'],
            ['mssv' => '2254810260', 'password' => bcrypt('123456'), 'hoten' => 'Nguyễn Trường Anh Vũ', 'ngaysinh' => '2004-07-20', 'gioitinh' => 'Nam', 'lop' => 'IT02', 'quequan' => 'Ho Chi Minh'],
            ['mssv' => '2254810271', 'password' => bcrypt('123456'), 'hoten' => 'Đoàn Huy Thiện', 'ngaysinh' => '2004-09-12', 'gioitinh' => 'Nam', 'lop' => 'IT02', 'quequan' => 'Ho Chi Minh'],
            ['mssv' => '2254810264', 'password' => bcrypt('123456'), 'hoten' => 'Cao Tuấn Khải', 'ngaysinh' => '2004-04-14', 'gioitinh' => 'Nam', 'lop' => 'IT02', 'quequan' => 'Ho Chi Minh'],

        ]);
    }
}
