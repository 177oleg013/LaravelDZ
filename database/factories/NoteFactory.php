<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'body' => fake()->paragraph(3),
            'status' => fake()->randomElement(array_keys(Note::STATUSES)),
            'due_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
