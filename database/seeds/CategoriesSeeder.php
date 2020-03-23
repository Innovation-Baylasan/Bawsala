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
            ->create([
                'name' => 'startups',
                'icon' => '/svg/startups-icon.svg',
                'icon_png' => '/svg/startups-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create([
                'name' => 'investors',
                'icon' => '/svg/investors-icon.svg',
                'icon_png' => '/svg/investors-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));

        factory(App\Category::class)
            ->create([
                'name' => 'accelerators',
                'icon' => '/svg/accelerators-icon.svg',
                'icon_png' => '/svg/accelerators-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));

        factory(App\Category::class)
            ->create([
                'name' => 'co-workspaces',
                'icon' => '/svg/co-workspaces-icon.svg',
                'icon_png' => '/svg/co-workspaces-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create([
                'name' => 'labs',
                'icon' => '/svg/labs-icon.svg',
                'icon_png' => '/svg/labs-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));


        factory(App\Category::class)
            ->create([
                'name' => 'research-centers',
                'icon' => '/svg/research-centers-icon.svg',
                'icon_png' => '/svg/research-centers-icon.svg'
            ])
             ->entities()->saveMany(factory(App\Entity::class, 5)->make(['category_id' => '']));

    }
}
