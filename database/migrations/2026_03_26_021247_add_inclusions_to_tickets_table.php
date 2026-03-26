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
        Schema::table('tickets', function (Blueprint $table) {
            // Use 'text' for a simple string list, or 'json' if you plan to store structured arrays
            $table->text('inclusions')->nullable()->after('quantity'); 
            // Note: ->after('column_name') positions the new column logically (MySQL only)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('inclusions');
        });
    }
};