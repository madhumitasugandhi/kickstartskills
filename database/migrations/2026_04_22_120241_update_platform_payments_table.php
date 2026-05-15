<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
{
    // ✅ STEP 1: Rename using MariaDB compatible syntax
    DB::statement("ALTER TABLE platform_payments CHANGE razorpay_order_id gateway_order_id VARCHAR(255)");
    DB::statement("ALTER TABLE platform_payments CHANGE razorpay_payment_id gateway_payment_id VARCHAR(255)");
    DB::statement("ALTER TABLE platform_payments CHANGE razorpay_signature gateway_signature VARCHAR(255)");

    // ✅ STEP 2: Add new columns
    Schema::table('platform_payments', function (Blueprint $table) {
        $table->string('transaction_id')->unique()->after('reference_id');
        $table->string('gateway')->after('transaction_id');
        $table->json('gateway_response')->nullable(); // remove 'after' for safety
    });

    // ✅ STEP 3: ENUM update
    DB::statement("ALTER TABLE platform_payments MODIFY status ENUM('pending','success','failed') DEFAULT 'pending'");
}

public function down()
{
    DB::statement("ALTER TABLE platform_payments CHANGE gateway_order_id razorpay_order_id VARCHAR(255)");
    DB::statement("ALTER TABLE platform_payments CHANGE gateway_payment_id razorpay_payment_id VARCHAR(255)");
    DB::statement("ALTER TABLE platform_payments CHANGE gateway_signature razorpay_signature VARCHAR(255)");

    Schema::table('platform_payments', function (Blueprint $table) {
        $table->dropColumn([
            'transaction_id',
            'gateway',
            'gateway_response'
        ]);
    });

    DB::statement("ALTER TABLE platform_payments MODIFY status ENUM('pending','paid','failed') DEFAULT 'pending'");
}
};
