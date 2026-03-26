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
        Schema::create('exams', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('skill_category_id'); // skill_cate_id
    $table->string('exam_name');
    $table->json('questions_id'); // Array of question IDs
    $table->integer('duration_minutes')->default(30); // Extra: Exam time
    $table->timestamps();

    $table->foreign('skill_category_id')->references('id')->on('skills_categories')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
