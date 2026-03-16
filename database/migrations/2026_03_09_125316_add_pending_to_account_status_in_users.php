<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // This modifies the EXISTING table rather than creating it again
        DB::statement("ALTER TABLE users MODIFY COLUMN account_status ENUM('active', 'deactivated', 'suspended', 'pending') DEFAULT 'pending'");
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
