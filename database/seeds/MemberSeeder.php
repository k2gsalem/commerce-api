<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m=Role::find(2);  //find Roll (Member)
        $m->syncPermissions(['List roles','List permissions','List config status','List config vendor','List product category','List product sub category','List vendor','List item','List item variant','List stock']);

        //
    }
}
