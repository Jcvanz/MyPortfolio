<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\CoreStack;

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

        Portfolio::create([
            'name' => 'Julio Cesar Vanz',
            'profissao' => 'Desenvolvedor Fullstack',
            'resumo' => 'Desenvolvedor apaixonado por tecnologia...',
            'email' => 'julio@example.com',
            'github' => 'https://github.com/Jcvanz',
            'linkedin' => 'https://linkedin.com/in/juliocesarvanz',
            'cidade' => 'Blumenau',
            'estado' => 'SC'
        ]);

        CoreStack::create([
            'name' => 'Laravel',
            'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg'
        ]);
    }
}
