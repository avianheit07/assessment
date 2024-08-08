<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Store;
use App\Models\User;
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
        $brands = Brand::factory(5)->create();
        $stores = Store::factory(10)->make()->each(function ($store) use ($brands) {
            $store->brand_id = $brands->random()->id;
            $store->save();
        });

        $users = User::factory(5)->create();
        $stores->each(function ($store) use ($users) {
            $store->users()->attach($users->random());
        });
    }
}
