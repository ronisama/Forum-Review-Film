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
        Schema::create('films', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_film')->index();
            $table->longText('sinopsis')->nullable();
            $table->string('release_year')->nullable();
            $table->string('poster')->nullable();
            $table->string('type')->nullable();
            $table->float('rating')->nullable();
            $table->string('director')->nullable();
            $table->string('tmdb_id')->nullable()->unique();
            $table->string('runtime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
