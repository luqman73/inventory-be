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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('storage_capacity');
            $table->foreignId('color_id')->constrained('colors');
            $table->timestamps();
        });

        Schema::create('stock', function(Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamp('last_update')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('transactions', function(Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->enum('transaction_type', ['addition', 'removal']);
            $table->integer('quantity_changed');
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('stock');
        Schema::dropIfExists('products');
        Schema::dropIfExists('colors');
    }
};
