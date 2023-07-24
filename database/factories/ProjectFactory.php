<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nome" => fake('it_IT') -> catchPhrase(),
            "descrizione" => fake('it_IT') -> paragraph(),
            "tecnology" => fake('it_IT') -> randomElement(['Vue.js', 'Vite', 'PHP', 'Laravel', 'JavaScript']),
            "link" => fake('it_IT') -> url(),
            "repo" => fake('it_IT') -> url(),
            "data" => fake('it_IT') -> date()
        ];
    }
}
