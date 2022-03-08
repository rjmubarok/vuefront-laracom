<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title');
            $table->string('slug');
            $table->string('sku');
            $table->float('price');
            $table->float('sell_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->enum('status', ['draft', 'publish', 'inactive'])->default('draft');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            //$table->integer('subcategory_id');
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            //$table->integer('parent_id')->nullable();
            $table->timestamps();
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
}
