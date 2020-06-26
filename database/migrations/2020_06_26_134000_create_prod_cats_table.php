<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_cats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_short_code',500);
            $table->mediumText('category_desc');
            $table->string('category_image',1000)->nullable();
            $table->integer('status_id')->default(1);
            // $table->foreign('status_id')->references('id')->on('conf_statuses');
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
        Schema::dropIfExists('prod_cats');
    }
}