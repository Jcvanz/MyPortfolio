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
        if (!User::where('email', 'julio@example.com')->exists()) {
            User::create([
                'name' => 'Julio Cesar Vanz',
                'email' => 'julio@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        if (Portfolio::query()->doesntExist()) {
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
        }

        if (CoreStack::query()->doesntExist()) {
            CoreStack::create([
                'name' => 'Laravel',
                'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg'
            ]);
        }
    }
}
