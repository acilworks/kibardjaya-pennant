<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nav_mega_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nav_item_id')->constrained('nav_items')->cascadeOnDelete();
            $table->string('label');
            $table->string('url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('nav_mega_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nav_mega_group_id')->constrained('nav_mega_groups')->cascadeOnDelete();
            $table->string('label');
            $table->string('url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_mega_items');
        Schema::dropIfExists('nav_mega_groups');
    }
};
