<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Run the API clients seeder
        $this->call('ClientsTableSeeder');

        // Run maps & callouts seeder, afterwards run the seeder that will assign callouts to maps
        $this->call('MapTableSeeder');
        $this->call('CalloutTableSeeder');
        $this->call('MapCalloutTableSeeder');

        // Run Quiz & questions seeder, afterwards assign questions to quizzes
        $this->call('QuizTableSeeder');
        $this->call('QuestionTableSeeder');
        $this->call('QuizQuestionTableSeeder');

    }
}
