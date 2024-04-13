<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateProductsTable Class
 *
 * This migration creates the 'products' table in the database.
 * The table has a UUID primary key and columns for name, description, price, soft deletes, and timestamps.
 * It extends the Migration class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function up(): void
    {
        // Create migration for products table with id as UUID and not auto-incrementing
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Define a UUID primary key
            $table->string('name'); // Define a column for product name
            $table->text('description')->nullable(); // Define a nullable column for product description
            $table->decimal('price', 10); // Define a decimal column for product price with precision 10 and scale 2
            $table->softDeletes(); // Add support for soft deletes
            $table->timestamps(); // Add timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function down(): void
    {
        // Create migration query to drop the 'products' table
        Schema::dropIfExists('products');
    }
};
