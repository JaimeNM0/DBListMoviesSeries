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
        Schema::create('valuations', function (Blueprint $table) {
            $table->id();
            $table->decimal('note', 2, 2)->nullable();
            $table->text('opinion')->nullable();
            //$table->enum('brand', ['planeada', 'viendola', 'vista', 'en espera', 'dejada'])->default('planeada');
            $table->enum('brand', ['planned', 'watching', 'completed', 'on hold', 'dropped'])->default('planned');
            $table->boolean('favorite')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            //$table->integer('num_chapter_watched')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('movies_id')->nullable();
            $table->unsignedBigInteger('series_id')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('movies_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valuations');
    }
};
