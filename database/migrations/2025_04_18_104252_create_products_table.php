<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('type');
            $table->string('series');
            $table->string('manufacturer')->nullable();
            $table->string('format')->nullable();
            $table->date('date_of_release');
            $table->text('description')->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->boolean('on_sale');
            $table->decimal('sale_percent', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
