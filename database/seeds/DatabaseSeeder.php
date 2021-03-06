<?php

use Dingo\Blueprint\Annotation\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConfStatusSeeder::class);
        $this->call(ConfPaymentStatusSeeder::class);
        $this->call(ConfOrderTypeSeeder::class);
        // $this->call(ConfSupplierCatSeeder::class);
        // $this->call(ConfVendorCatSeeder::class);
        // $this->call(ProdCatSeeder::class);
        // $this->call(ProdSubCatSeeder::class);

        //  $this->call(VendorSeeder::class);
        //  $this->call(SupplierSeeder::class);
        // $this->call(AssetsSeeder::class);
        //  $this->call(ItemSeeder::class);
        //  $this->call(ItemVariantGroupSeeder::class);
        //  $this->call(ItemVariantSeeder::class);

        //  $this->call(StockMasterSeeder::class);
        //  $this->call(StockTrackerSeeder::class);


        $this->call(PassportSeeder::class);
        // $this->call(MemberSeeder::class);
    }
}
