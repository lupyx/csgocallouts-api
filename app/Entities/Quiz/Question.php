<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Base\TranslatableModel;
use App\Entities\Callout;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends TranslatableModel
{
    protected $fillable = [ 'content' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];
    protected $translatable = [ 'content' ];

    public $preparedAnswers = [];

    /**
     * @return BelongsTo
     */
    public function answer() : BelongsTo
    {
        return $this->belongsTo(Callout::class, 'questions_answers');
    }

    /**
     * @return BelongsToMany
     */
    public function quizzes() : BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'quizzes_questions');
    }


    /**
     * @param int $amountOfChoices The amount of choices (correct answer included) this method should generate
     * Will generate the preparedAnswers[] property of this class including the right answer and wrong answers
     */
    public function prepareForAnswer(int $amountOfChoices = 4) : void
    {
        $this->preparedAnswers[] = $this->answer;
        $wrongAnswers = Callout::whereNotIn('id', $this->answer->id)->inRandomOrder()->take($amountOfChoices - 1);

        foreach($wrongAnswers as $wrongAnswer)
            $this->preparedAnswers[] = $wrongAnswer;

        $this->preparedAnswers = shuffle($this->preparedAnswers);
    }
}