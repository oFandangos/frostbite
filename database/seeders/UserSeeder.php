<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'codpes' => '123456',
            'email' => 'fulano@usp.br',
            'name' => 'Fulano da Silva de Andrade',
            'password' => '$2y$12$gfpp9OofkkD/OhIG/72Nu.CiIwnGYyed2gZbxxuQS7eXAAUa7g4Lq',
            'is_admin' => TRUE
        ];
        User::create($user); //vai criar só o $user, isto é, o usuario acima;
        User::factory(2)->create(); //vai criar registros com base no Uspdev/Replicado e Uspdev/faker.
    }
}
