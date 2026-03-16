<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('student_profiles', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('user_id');
        $table->string('country')->nullable()->after('phone');
        $table->string('institution_code')->nullable()->after('institution_id');
        // We can keep 'skills_tags' for a quick comma-separated list,
        // but the 'student_skills' table is better for the chips.
    });
}

    public function down(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            //
        });
    }
};
