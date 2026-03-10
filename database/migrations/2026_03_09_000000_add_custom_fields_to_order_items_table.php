<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Make product_id nullable for custom items (no Product record)
            $table->unsignedBigInteger('product_id')->nullable()->change();

            // Store custom pennant name for items without a product
            $table->string('product_name')->nullable()->after('variation_name');

            // Store custom options as JSON text (flag_color, border_color, text, font, etc.)
            $table->text('custom_options')->nullable()->after('product_name');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'custom_options']);
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
        });
    }
};
