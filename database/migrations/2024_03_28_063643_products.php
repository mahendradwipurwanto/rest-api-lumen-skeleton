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
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function up(): void
    {
        // create migration for products table with id is uuid not auto increment
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function down(): void
    {
        //create migration query to drop table products
        Schema::dropIfExists('products');
    }
};
