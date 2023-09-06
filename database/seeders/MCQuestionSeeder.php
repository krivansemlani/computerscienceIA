<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MCQuestion;

class MCQuestionSeeder extends Seeder
{
    public function run()
    {
        // Create 50 dummy multiple-choice questions associated with random chapters
        MCQuestion::factory(50)->create();
    }
}
