<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTokensTable extends Migration
{
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('mssv');
            $table->string('token', 64)->unique();
            $table->timestamps();
            $table->foreign('mssv')->references('mssv')->on('sinhvien')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_tokens');
    }
}
