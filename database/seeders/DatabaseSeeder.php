<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

   
    public function run(): void
    {
        User::create([
            'name' => 'Julio Cesar Vanz',
            'email' => 'julio@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Portfolio::create([
            'name' => 'Julio Cesar Vanz',
            'bio' => 'Desenvolvedor Fullstack',
            'email' => 'julio@example.com',
            'github' => 'https://github.com/Jcvanz',
            'linkedin' => 'https://linkedin.com/in/juliocesarvanz',
            'city' => 'Blumenau',
            'state' => 'SC'
        ]);

        \App\Models\CoreStack::create([
            'name' => 'Laravel',
            'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg'
        ]);
    }
}
