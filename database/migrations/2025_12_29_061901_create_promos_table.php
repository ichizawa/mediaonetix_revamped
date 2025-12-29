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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->double('amount', 8, 2);
            $table->boolean('type')->default(0);
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger(column: 'user_id');
            $table->smallInteger('status')->default(0);
            $table->date('valid');
            $table->bigInteger('quantity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
