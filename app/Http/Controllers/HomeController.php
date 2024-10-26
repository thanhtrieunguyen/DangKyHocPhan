<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function getHome()
    {
        $sinhvien = Auth::user();
        $hoten = $sinhvien->hoten;

        return view('home', compact('hoten', 'sinhvien'));
    }

    public function getAdminHome()
    {
        return view('admin.home'); // Tạo một view riêng cho admin
    }
}

