<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('promo_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->bigInteger('customer_phone');
            $table->string('customer_address');
            $table->string('customer_city');
            $table->date('customer_birthdate');
            $table->bigInteger('quantity');
            $table->double('total_amount', 8, 2);
            $table->smallInteger('status');
            $table->string('payment_intent_id')->nullable();
            $table->string('payment_method');
            $table->string('purchase_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->uuid('reference_number');
            $table->boolean('is_online')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_tracked')->default(0);
            $table->boolean('is_email_sent')->default(0);
            $table->boolean('is_email_resent')->default(0);
            $table->boolean('is_sms_sent')->default(0);
            $table->boolean('is_sms_resent')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
