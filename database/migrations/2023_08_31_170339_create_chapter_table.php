<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->id();
            $table->string("CName");
            $table->string("CDescription");
            $table->foreignId('subject_id')->constrained('subject');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter');
    }
};
