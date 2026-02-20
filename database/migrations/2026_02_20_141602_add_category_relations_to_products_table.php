<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->after('is_featured');
            $table->foreignId('sub_category_id')->nullable()->constrained()->nullOnDelete()->after('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['sub_category_id', 'category_id']);
        });
    }
};
