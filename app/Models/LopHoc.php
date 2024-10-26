<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;

    protected $table = 'lophoc';
    protected $primaryKey = 'malop';
    public $incrementing = true;

    // Liên kết với bảng Khoa
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa', 'makhoa');
    }

    public function dsdangky()
    {
        return $this->hasMany(SinhVien::class, 'malop', 'malop');
    }
}
