<?php

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
        factory(App\Category::class, 6)
            ->create()
            ->each(function ($category) {
                $category->entities()->saveMany(factory(App\Entity::class,5)->make());
            });
    }
}
