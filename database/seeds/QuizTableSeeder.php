<?php

use Illuminate\Database\Seeder;
use App\Entities\Quiz\Quiz;

class QuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            ['id' => 1, 'title' => 'Spots Knowledge', 'map_id' => 1, 'time_limit' => 120],
        ];

        Quiz::insert($quizzes);
    }
}
