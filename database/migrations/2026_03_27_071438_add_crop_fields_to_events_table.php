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
        Schema::table('events', function (Blueprint $table) {
            $table->integer('crop_x')->nullable()->after('event_image');
            $table->integer('crop_y')->nullable()->after('crop_x');
            $table->integer('crop_width')->nullable()->after('crop_y');
            $table->integer('crop_height')->nullable()->after('crop_width');
            $table->integer('crop_natural_width')->nullable()->after('crop_height');
            $table->integer('crop_natural_height')->nullable()->after('crop_natural_width');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'crop_x',
                'crop_y',
                'crop_width',
                'crop_height',
                'crop_natural_width',
                'crop_natural_height',
            ]);
        });
    }
};
