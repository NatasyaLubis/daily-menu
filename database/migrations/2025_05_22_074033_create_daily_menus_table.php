<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMenusTable extends Migration
{
    public function up()
    {
        Schema::create('daily_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->json('ingredients'); // Simpan bahan makanan sebagai array JSON
            $table->integer('budget');    // Bujet harian dalam rupiah
            $table->json('recommendations'); // Menu rekomendasi dalam JSON
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_menus');
    }
}
