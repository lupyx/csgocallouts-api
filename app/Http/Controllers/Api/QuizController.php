<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Quiz\Question;
use App\Entities\Quiz\Quiz;
use App\Entities\Quiz\UserQuiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function quizzes(): JsonResponse
    {
        return response()->json(Quiz::with('questions')->get());
    }

    public function quiz(int $quizId): JsonResponse
    {
        return response()->json(Quiz::findOrFail($quizId)->with('questions'));
    }

    public function userQuizzes(Request $request) : JsonResponse
    {
        $user = $request->get('user');
        return response()->json(UserQuiz::where('user_id', $user->id)->with('quiz')->first());
    }

    public function userQuiz(Request $request, int $userQuizId) : JsonResponse
    {
        return response()->json(UserQuiz::findOrFail($userQuizId)->with('quiz'));
    }

    public function generateQuiz(Request $request, int $quizId) : JsonResponse
    {
        $user = $request->get('steamUser');
        $quiz = Quiz::findOrFail($quizId);

        $userQuiz = UserQuiz::create([
            'user_id' => $user->id,
            'quiz_id' => $quizId,
            'score' => 0,
            'max_score' => count($quiz->questions),
            'finished' => 0
        ])->with('quiz.questions');

        return response()->json($userQuiz);
    }

    public function checkQuestion(Request $request, int $userQuizId) : JsonResponse
    {
        $this->validate($request, [
            'question_id' => 'required|numeric',
            'answer' => 'required|alpha'
        ]);

        $question = Question::findOrFail($request->get('question_id'));
        $answer = strtolower($request->get('answer'));

        $correct = ($answer == strtolower($question->answer->name));
        $userQuiz = UserQuiz::findOrFail($userQuizId);

        if($correct)
        {
            $userQuiz->score++;
            $userQuiz->save();
        }

        return response()->json(['correct' => $correct, 'user_quiz' => $userQuiz]);
    }

    public function finishQuiz(int $userQuizId) : JsonResponse
    {
        $userQuiz = UserQuiz::findOrFail($userQuizId);
        $userQuiz->finished = 1;
        $userQuiz->save();

        return response()->json($userQuiz);
    }
}
