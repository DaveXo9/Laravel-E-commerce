<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->text('description');
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('special_price', 8, 2);
            $table->unsignedInteger('quantity');
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
