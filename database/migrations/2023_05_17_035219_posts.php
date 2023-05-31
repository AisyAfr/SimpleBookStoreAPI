<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function(Blueprint $table){
            $table->id();
            $table->string('judul',200);
            $table->text('deskripsi');
            $table->unsignedBigInteger('penjual');
            $table->string('harga', 50);
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('penjual')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
