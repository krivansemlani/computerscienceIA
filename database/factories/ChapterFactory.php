<?php
namespace Database\Factories;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;

    public function definition()
    {
        return [
            'CName' => $this->faker->words(3, true), // Generate a random name
            'CDescription' => $this->faker->sentence(), // Generate random description
            'subject_id' => Subject::factory(), // Associate with a subject
        ];
    }
}

