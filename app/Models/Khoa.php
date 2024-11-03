<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;

    protected $table = 'khoa';
    protected $primaryKey = 'makhoa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tenkhoa',
        'makhoa',
    ];
    // Liên kết với bảng LopHoc
    public function lops()
    {
        return $this->hasMany(LopHoc::class, 'makhoa', 'makhoa');
    }

    // Liên kết với bảng MonHoc
    public function monhocs()
    {
        return $this->hasMany(MonHoc::class, 'makhoa', 'makhoa');
    }

    public function sinhviens()
    {
        return $this->hasMany(SinhVien::class, 'makhoa', 'makhoa');
    }
}
