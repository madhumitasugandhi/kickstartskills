<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE student_drive_payments MODIFY status ENUM('pending','success','failed') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE student_drive_payments MODIFY status ENUM('pending','paid','failed') DEFAULT 'pending'");
    }
};
