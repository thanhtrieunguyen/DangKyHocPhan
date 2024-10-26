<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonhocTable extends Migration
{
    public function up()
    {
        Schema::create('monhoc', function (Blueprint $table) {
            $table->string('mamonhoc')->primary();
            $table->string('tenmonhoc');
            $table->string('giangvien');
            $table->string('lichhoc')->nullable();
            $table->integer('sotinchi');
            $table->integer('soluongsinhvien');
            $table->integer('dadangky')->default(0);
            $table->string('makhoa');
            $table->foreign('makhoa')->references('makhoa')->on('khoa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monhoc');
    }
}
