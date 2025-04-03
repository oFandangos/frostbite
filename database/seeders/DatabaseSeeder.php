<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
                // User::factory(10)->create();
        $this->call([
            UserSeeder::class //chamando o seeder UserSeeder, que contem o Replicado e o Faker (composer require uspdev/replicado - uspdev/laravel-usp-fake)
        ]);
    }
}
