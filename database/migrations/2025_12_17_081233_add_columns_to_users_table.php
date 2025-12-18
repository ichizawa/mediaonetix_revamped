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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->date('dob')->nullable();
            $table->smallInteger('gender')->default(0);
            $table->string('country')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->smallInteger('is_email_sent')->default(0);
            $table->smallInteger('is_email_resent')->default(0);
            $table->boolean('is_active')->default(0);
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('city');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('country');
            $table->dropColumn('zip_code');
            $table->dropColumn('address');
            $table->dropColumn('image');
            $table->dropColumn('is_email_sent');
            $table->dropColumn('is_email_resent');
            $table->dropColumn('is_active');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
