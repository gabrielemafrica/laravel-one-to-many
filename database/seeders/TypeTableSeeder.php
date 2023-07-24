<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Sito Web', 'Applicazione Web', 'App Mobile', 'E-commerce', 'Blog', 'AppCheSpacca', 'Progetto di Scuola'
        ];

        foreach ($types as $type) {
            Type :: create([
                "type" => $type
            ]);
        }
    }
}
