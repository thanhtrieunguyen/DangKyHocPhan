<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LophocSeeder extends Seeder
{
    public function run()
    {
        DB::table('lophoc')->insert([
            ['malop' => 1, 'tenlop' => 'TT01', 'makhoa' => 'CNTT'],
            ['malop' => 2, 'tenlop' => 'TT02', 'makhoa' => 'CNTT'],
            ['malop' => 3, 'tenlop' => 'KT01', 'makhoa' => 'KT'],
            ['malop' => 4, 'tenlop' => 'KT02', 'makhoa' => 'KT'],
            ['malop' => 5, 'tenlop' => 'CB01', 'makhoa' => 'CB'],
            ['malop' => 6, 'tenlop' => 'CB02', 'makhoa' => 'CB'],

        ]);
    }
}
