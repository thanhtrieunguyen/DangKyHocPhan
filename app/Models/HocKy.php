<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    use HasFactory;

    protected $table = 'hocky';
    protected $primaryKey = 'mahocky';

    protected $fillable = [
        'mahocky',
        'tenhocky',
        'ngaybatdau',
        'ngayketthuc',
        'namhoc',
        'trangthai',
    ];

    protected $casts = [
        'mahocky' => 'string', // Đảm bảo đây là chuỗi
    ];


    public function hocky_sinhvien()
    {
        return $this->hasMany(HocKy_SinhVien::class, 'mahocky', 'mahocky');
    }

    public function monhoc()
    {
        return $this->hasMany(MonHoc::class, 'mahocky', 'mahocky');
    }
}
