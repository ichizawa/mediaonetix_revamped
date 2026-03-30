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
        Schema::table('customer_tickets', function (Blueprint $table) {
            $table->boolean('is_disabled')->default(0)->nullable();
            $table->unsignedBigInteger('scanned_by')->nullable();
            $table->foreign('scanned_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_tickets', function (Blueprint $table) {
            //
        });
    }
};
