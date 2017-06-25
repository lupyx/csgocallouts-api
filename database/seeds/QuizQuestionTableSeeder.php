<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz_questions = [
            ['quiz_id' => 1, 'question_id' => 1],
            ['quiz_id' => 1, 'question_id' => 2],
            ['quiz_id' => 1, 'question_id' => 3],
        ];

        DB::table('quizzes_questions')->insert($quiz_questions);
    }
}
