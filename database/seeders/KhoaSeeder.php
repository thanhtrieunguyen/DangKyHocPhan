<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhoaSeeder extends Seeder
{
    public function run()
    {
        DB::table('khoa')->insert([
            ['makhoa' => 'CNTT', 'tenkhoa' => 'Công nghệ thông tin'],
            ['makhoa' => 'KT', 'tenkhoa' => 'Kinh tế'],
            ['makhoa' => 'CB', 'tenkhoa' => 'Cơ bản'],
        ]);
    }
}
