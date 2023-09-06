<?php
// database/factories/QRQuestionFactory.php
// database/factories/QRQuestionFactory.php
// database/factories/QRQuestionFactory.php

namespace Database\Factories;

use App\Models\RevisionQuestion; // Updated to use the correct model
use Illuminate\Database\Eloquent\Factories\Factory;

class QRQuestionFactory extends Factory
{
    protected $model = RevisionQuestion::class;

    public function definition()
    {
        return [
            'QImage' => 'path/to/your/image.jpg', // Provide a real or fake image path
            'AImage' => 'path/to/your/answer/image.jpg', // Provide a real or fake answer image path
            'chapter_id' => \App\Models\Chapter::factory(),
        ];
    }
}

