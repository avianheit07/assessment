<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Journal;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
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
        $startDate = Carbon::now()->subYear()->startOfYear();
        $endDate = Carbon::now()->subYear()->endOfYear();
        
        $stores->each(function ($store) use ($users, $startDate, $endDate) {
            $store->users()->attach($users->random());
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                Journal::factory()->create([
                    'store_id' => $store->id,
                    'date' => $currentDate->toDateString(),
                ]);
                $currentDate->addDay();
            }
        });
    }
}
