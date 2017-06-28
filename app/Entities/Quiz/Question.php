<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Base\TranslatableModel;
use App\Entities\Callout;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Question extends TranslatableModel
{
    protected $fillable = [ 'content' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at', 'answer_id', 'answer' ];
    protected $translatable = [ 'content' ];
    protected $appends = ['preparedAnswers'];
    protected $preparedAnswers = [];

    /**
     * @return BelongsTo
     */
    public function answer() : BelongsTo
    {
        return $this->belongsTo(Callout::class, 'answer_id');
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
    public function prepareForAnswer(int $amountOfChoices = 4)
    {
        $this->preparedAnswers[] = $this->answer->name;
        $id = $this->id;
        $wrongAnswersNeeded = $amountOfChoices - 1;
        $wrongAnswers =
            DB::select("SELECT * FROM callouts WHERE id NOT IN (SELECT answer_id FROM questions WHERE id=$id) ORDER BY RAND() LIMIT $wrongAnswersNeeded");

        foreach($wrongAnswers as $wrongAnswer) {
            $this->preparedAnswers[] = $wrongAnswer->name;
        }

        shuffle($this->preparedAnswers);
    }

    public function getPreparedAnswersAttribute()// : array
    {
        return $this->preparedAnswers;
    }
}