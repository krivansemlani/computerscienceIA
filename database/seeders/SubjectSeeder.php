<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // Create 10 dummy subjects
        Subject::factory(10)->create();
    }
}
