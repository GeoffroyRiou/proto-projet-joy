<?php

namespace Database\Factories;

use App\Enums\WorkToolsAges;
use App\Enums\WorkToolsCategories;
use App\Enums\WorkToolsSkills;
use App\Enums\WorkToolsTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Worktool>
 */
class WorkToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'category' => implode(',', fake()->randomElements(WorkToolsCategories::getAllValues(), rand(1, 3))),
            'ages' => implode(',', fake()->randomElements(WorkToolsAges::getAllValues(), rand(1, 3))),
            'skills' => implode(',', fake()->randomElements(WorkToolsSkills::getAllValues(), rand(1, 3))),
            'type' => fake()->randomElement(WorkToolsTypes::getAllValues()),
        ];
    }
}
