<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Base\TranslatableModel;
use App\Entities\Map;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quiz extends TranslatableModel
{
    protected $hidden = [ 'created_at', 'updated_at' ];
    protected $translatable = [ 'title' ];

    public function questions() : BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'quizzes_questions');
    }

    public function map() : HasOne
    {
        return $this->hasOne(Map::class);
    }
}