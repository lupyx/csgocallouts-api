<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;


use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserQuiz extends Model
{
    protected $table = 'users_quizzes';
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz() : BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}