<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = Technology :: factory() -> count(23) -> create();

        foreach($technologies as $technology) {
            $projects = Project :: inRandomOrder() -> limit(rand(1, 5)) -> get();
            $technology -> projects() -> attach($projects);
        }
    }
}
