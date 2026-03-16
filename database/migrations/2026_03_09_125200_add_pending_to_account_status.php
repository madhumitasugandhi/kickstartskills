<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // This command adds 'pending' to the allowed list in MySQL
        DB::statement("ALTER TABLE users MODIFY COLUMN account_status ENUM('active', 'deactivated', 'suspended', 'pending') DEFAULT 'pending'");
    }

    public function down()
    {
        // This reverts the table if you ever need to undo the change
        DB::statement("ALTER TABLE users MODIFY COLUMN account_status ENUM('active', 'deactivated', 'suspended') DEFAULT 'active'");
    }
};
