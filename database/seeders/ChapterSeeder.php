<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Chapter;

class ChapterSeeder extends Seeder
{
    public function run()
    {
        // Create 30 dummy chapters associated with random subjects
        Chapter::factory(30)->create();
    }
}

