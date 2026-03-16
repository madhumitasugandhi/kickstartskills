<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // This adds 'pending' to the allowed list in your database
        DB::statement("ALTER TABLE users MODIFY COLUMN account_status ENUM('active', 'deactivated', 'suspended', 'pending') DEFAULT 'pending'");
    }

    public function down()
    {
        // Reverts to the original three statuses
        DB::statement("ALTER TABLE users MODIFY COLUMN account_status ENUM('active', 'deactivated', 'suspended') DEFAULT 'active'");
    }
};
