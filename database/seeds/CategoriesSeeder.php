<?php

use App\Profile;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class)
            ->create(['name' => 'startups',
                'icon' => '/svg/startups-icon.svg'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'investors',
                'icon' => '/svg/investors-icon.svg'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'labs',
                'icon' => '/svg/labs-icon.svg'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create(['name' => 'research',
                'icon' => '/svg/research-centers-icon.svg'])
            ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));

    }
}
