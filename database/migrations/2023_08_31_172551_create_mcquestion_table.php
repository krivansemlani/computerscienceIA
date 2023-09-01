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
        Schema::create('mcquestion', function (Blueprint $table) {
            $table->id();
            $table->string("QImage");
            $table->string("Option1");
            $table->string("Option2");
            $table->string("Option3");
            $table->string("Option4");
            $table->enum("Answer", ["Option1", "Option2", "Option3", "Option4"]);


            $table->foreignId('chapter_id')->constrained('chapter');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcquestion');
    }
};
