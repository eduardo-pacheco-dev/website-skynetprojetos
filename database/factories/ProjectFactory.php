<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(2, true);

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'client' => fake()->company(),
            'summary' => fake()->sentence(15),
            'description' => fake()->paragraphs(3, true),
            'cover_image' => null,
            'project_url' => fake()->optional()->url(),
            'technologies' => fake()->randomElements(
                ['Laravel', 'Vue.js', 'React', 'MySQL', 'Docker', 'Tailwind CSS', 'Filament', 'AWS'],
                fake()->numberBetween(2, 4),
            ),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'completed_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
