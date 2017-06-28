<?php

use Illuminate\Database\Seeder;
use App\Entities\Quiz\Question;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['id' => 1, 'content' => 'What is this spot called?', 'answer_id' => 1],
            ['id' => 2, 'content' => 'Where is the terrorist standing?', 'answer_id' => 2],
            ['id' => 3, 'content' => 'What are the two spots the terrorists are standing on?', 'answer_id' => 3],
            ['id' => 4, 'content' => 'What are the two spots the terrorists are standing on?', 'answer_id' => 4],
        ];

        Question::insert($questions);
    }
}
