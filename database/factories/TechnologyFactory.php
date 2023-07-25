<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake('it_IT') -> unique() -> randomElement([
                'Vue.js', 'Vite', 'PHP', 'Laravel', 'JavaScript', 'HTML', 'CSS',
                'React', 'Node.js', 'Express.js', 'Python', 'Django', 'MySQL',
                'PostgreSQL', 'MongoDB', 'Ruby', 'Ruby on Rails', 'Java', 'Spring',
                'C#', '.NET', 'Swift', 'iOS'
            ]),
        ];
    }
}
