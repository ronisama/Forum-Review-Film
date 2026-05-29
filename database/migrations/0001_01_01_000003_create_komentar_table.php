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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id');
            $table->longText('isi_komentar');

            //nullable agar tidak error saat tidak ada komentar yang reply ke komentar lain
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('thread_id');


            //parentID untuk foreign key ke table sendiri
            $table->foreign('parent_id')
                ->references('id')->on('komentar')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //fk users
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //fk threads
            $table->foreign('thread_id')
                ->references('id')->on('threads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
