<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

// SteamAuth register
$app->post('/steamuser/{steamId64}', 'SteamAuthController@registerUser');

$app->get('/map/{id}', 'MapsController@map');
$app->get('/maps', 'MapsController@maps');
$app->post('/map', 'MapsController@addMap');

$app->group(['middleware' => 'steamAuth'], function () use ($app) {

    $app->group(['prefix' => 'quiz'], function() use ($app) {

        $app->post('/{quizId}/prepare', 'QuizController@generateQuiz');

        $app->post('/{userQuizId}/checkAnswer', 'QuizController@checkAnswer');

        $app->post('/{userQuizId}/finish', 'QuizController@finishQuiz');

        $app->get('/userquiz/{userQuizId}', 'QuizController@userQuiz');

        $app->get('/userquizzes', 'QuizController@userQuizzes');

        $app->get('/quizzes', 'QuizController@quizzes');

        $app->get('/quiz/{quizId}', 'QuizController@quiz');
    });
});
