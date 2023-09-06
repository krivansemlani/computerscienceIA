<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MCQuestion;

class MCQuestionFactory extends Factory
{
    protected $model = MCQuestion::class;

    public function definition()
    {
        return [
            'QImage' => 'path/to/your/image.jpg', // Provide a real or fake image path
            'Option1' => $this->faker->word, // Column name with a space
            'Option2' => $this->faker->word, // Continue with other columns
            'Option3' => $this->faker->word,
            'Option4' => $this->faker->word,
            'Answer' => $this->faker->numberBetween(1, 4),
            'chapter_id' => \App\Models\Chapter::factory(),
        ];
    }
}

