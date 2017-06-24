<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;


use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserQuiz extends Model
{
    protected $table = 'users_quizzes';
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }

    public function quiz() : HasOne
    {
        return $this->hasOne(Quiz::class);
    }
}