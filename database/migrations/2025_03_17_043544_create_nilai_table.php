<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teacher')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
            $table->decimal('nilai', 5, 2); // Nilai dengan dua angka desimal
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};
