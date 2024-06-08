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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('poster')->nullable();
            $table->text('description')->nullable();
            $table->json('genre')->nullable();
            $table->string('duration')->nullable();
            $table->string('year')->nullable();
            $table->decimal('total_note', 2, 2)->nullable();
            $table->integer('total_registered')->nullable();
            $table->integer('num_favorite')->nullable();
            $table->string('ip_api')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
