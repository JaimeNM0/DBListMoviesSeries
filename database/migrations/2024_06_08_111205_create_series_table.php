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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('poster');
            $table->text('description');
            $table->json('genre');
            $table->string('duration');
            $table->date('start_date');
            $table->decimal('total_note', 2, 2)->nullable();
            $table->integer('total_registered')->nullable();
            $table->integer('num_favorite')->nullable();
            $table->integer('num_season')->nullable();
            $table->integer('num_chapter')->nullable();
            $table->string('ip_api');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
