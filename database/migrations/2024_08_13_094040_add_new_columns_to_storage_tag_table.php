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
        Schema::table('storage_tags', function (Blueprint $table) {
            $table->string('product_name')->after('user_id');
            $table->decimal('product_weight', 10,2)->after('user_id');
            $table->renameColumn('bio', 'product_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('storage_tags', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'product_weight']);
            $table->renameColumn('product_details', 'bio');
        });
    }
};
