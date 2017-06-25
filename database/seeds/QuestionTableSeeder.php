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
            ['id' => 1, 'content' => 'What is this spot called?'],
            ['id' => 2, 'content' => 'Where is the terrorist standing?'],
            ['id' => 3, 'content' => 'What are the two spots the terrorists are standing on?']
        ];

        Question::insert($questions);
    }
}
