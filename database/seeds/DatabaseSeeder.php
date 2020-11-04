<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
         	UserSeed::class,
            SliderSeed::class,
            SettingSeed::class,
            CategorySeed::class,
            ProductSeed::class,
            InfoSeed::class,
            WishlistSeed::class
         ]);
    }
}
