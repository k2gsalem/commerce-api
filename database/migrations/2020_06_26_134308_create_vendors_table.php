<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vendor_name',1000);
            $table->string('vendor_logo',1000)->nullable();
            $table->bigInteger('vendor_category_id')->unsigned();
            $table->foreign('vendor_category_id')->references('id')->on('conf_vendor_cats');
            $table->mediumText('vendor_desc')->nullable();
            $table->mediumText('vendor_address')->nullable();
            $table->mediumText('vendor_contact')->nullable();
            $table->mediumText('vendor_email')->nullable();
            // $table->bigInteger('status_id')->unsigned();
            $table->integer('status_id')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::dropIfExists('vendors');
    }
}
