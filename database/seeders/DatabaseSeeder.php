<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SubjectSeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(MCQuestionSeeder::class);
        $this->call(QRQuestionSeeder::class);
    }
}
