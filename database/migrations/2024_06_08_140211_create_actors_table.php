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
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('character')->nullable();
            $table->string('photo')->nullable();
            $table->string('id_actor')->unique();
            $table->unsignedBigInteger('movies_id')->nullable();
            $table->timestamps();

            $table->foreign('movies_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actors');
    }
};
