<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('cat_id')->nullable()->constrained('cats')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'cat_id']);
            $table->unique(['user_id', 'product_id']);
        });

        // setelah blueprint, tambahkan raw check constraint (MySQL 8.0.16+):
        DB::statement('ALTER TABLE favorites ADD CONSTRAINT chk_favorite_target 
            CHECK ((cat_id IS NOT NULL AND product_id IS NULL) OR (cat_id IS NULL AND product_id IS NOT NULL))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
