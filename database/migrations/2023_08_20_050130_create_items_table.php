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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('itemCode')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('categoryId');
            $table->string('subcategoryId')->nullable();
            $table->string('costPrice');
            $table->string('sellingPrice');
            $table->string('warranty');
            $table->string('vatTax')->nullable();
            $table->string('unit')->nullable();
            $table->string('quantity')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->string('brandName')->nullable();
            $table->string('expiryDate')->nullable();
            $table->foreignId('vendorId');
            $table->foreign('vendorId')->on('vendors')->references('id')->onDelete('cascade');
            $table->foreignId('userId');
            $table->foreign('userId')->on('users')->references('id')->onDelete('cascade');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('items');
    }
};
