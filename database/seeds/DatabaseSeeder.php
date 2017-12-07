<?php

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
        factory(App\Clients::class, 50)->create();
        factory(App\ClientsFL::class, 150)->create();
        factory(App\cat::class, 150)->create();
        factory(App\services::class, 150)->create();
        factory(App\contract::class, 250)->create();
        factory(App\servoncontr::class, 450)->create();
        factory(App\controncat::class, 100)->create();

    }
}
