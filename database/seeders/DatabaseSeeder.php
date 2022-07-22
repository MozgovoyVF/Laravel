<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\RoleUserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $role = Role::factory()->create([
            'name' => 'Администратор',
            'slug' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'Пользователь',
            'slug' => 'user',
        ]);

        User::factory()->hasAttached($role)->create([
            'name' => 'Администратор',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('12345'),
        ]);

        $this->call([
            UsersArticlesSeeder::class,
        ]);
    }
}
