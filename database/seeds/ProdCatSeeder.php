<?php

use Illuminate\Database\Seeder;

class ProdCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entities\Config\ProdCat::class,30)->create();
        //
    }
}