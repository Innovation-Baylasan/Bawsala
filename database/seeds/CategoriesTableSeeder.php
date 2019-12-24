<?php

use App\Profile;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class)
            ->create(['name' => 'startups'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'investors'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'labs'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'research'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));

    }
}
