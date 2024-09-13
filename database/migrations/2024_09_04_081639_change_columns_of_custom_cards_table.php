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
        Schema::table('custom_cards', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('tel_no');
            $table->addColumn('boolean', 'status')->after('url')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_cards', function (Blueprint $table) {
            $table->string('name');
            $table->string('email');
            $table->string('tel_no');
            $table->dropColumn('status');
        });
    }
};
