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
        if (!Schema::hasColumn('events', 'performers')) {
            Schema::table('events', function (Blueprint $table) {
                $table->json('performers')->nullable()->after('crop_natural_height');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('events', 'performers')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('performers');
            });
        }
    }
};
