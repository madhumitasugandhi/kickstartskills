<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('student_skills', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('skill_name'); // The student just types "React" or "Python"
        $table->string('type');       // 'current' or 'goal'
        $table->string('level');      // 'Beginner', 'Intermediate', or 'Advanced'
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('student_skills');
    }
};
