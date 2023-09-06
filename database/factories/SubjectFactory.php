<?php

// database/factories/SubjectFactory.php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'SName' => $this->faker->word,
            'SDescription' => $this->faker->sentence,
        ];
    }
}
