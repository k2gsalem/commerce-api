<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('variant_code',200)->unique();
            $table->unsignedBigInteger('variant_group_id');
            $table->foreign('variant_group_id')->references('id')->on('item_variant_groups')->onDelete('cascade');
            $table->mediumText('variant_desc',1000);
            $table->string('title',1000);
            $table->integer('min_order_quantity')->unsigned()->nullable();
            $table->decimal('min_order_amount',10,2)->nullable();
            $table->integer('max_order_quantity')->unsigned()->nullable(); 
            $table->decimal('max_order_amount',10,2)->nullable();
            $table->integer('quantity')->unsigned()->nullable();
            $table->integer('threshold')->unsigned()->nullable();
            $table->decimal('discount_percentage',10,2)->nullable();
            $table->decimal('discount_amount',10,2)->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            // $table->string('item_image',1000)->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_store_id');
            $table->foreign('vendor_store_id')->references('id')->on('vendor_stores')->onDelete('cascade');
            $table->decimal('MRP',10,2)->nullable();
            $table->decimal('selling_price',10,2)->nullable();
            $table->boolean('default')->default(FALSE); 
            $table->unique(['item_id','variant_code','variant_group_id']);           
            // $table->string('variant_image',500)->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('conf_statuses')->onDelete('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_variants');
    }
}

