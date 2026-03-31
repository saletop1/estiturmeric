<?php
// database/migrations/2025_01_01_000001_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('Produk Rempah');
            $table->text('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();          // extra images
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('price_old', 15, 2)->nullable();
            $table->string('unit')->default('kg');        // kg, ton, etc
            $table->integer('min_order')->default(1);
            $table->string('badge')->nullable();          // "Baru", "Terlaris"
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            // Lab data (for dried turmeric etc)
            $table->json('lab_data')->nullable();
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
