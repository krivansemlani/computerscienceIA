<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Database\Factories\QRQuestionFactory;


class QRQuestionSeeder extends Seeder
{
    public function run()
    {
        // Create 40 dummy QRQ questions associated with random chapters
        \App\Models\RevisionQuestion::factory(QRQuestionFactory::class)->count(40)->create();
    }
}
