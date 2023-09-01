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
        Schema::create('_q_r_question', function (Blueprint $table) {
            $table->id();
            $table->string("QImage");
            $table->string("AImage");
            $table->foreignId('chapter_id')->constrained('chapter');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_q_r_question');
    }
};
