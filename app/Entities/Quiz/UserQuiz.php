<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;


class UserQuiz
{
    protected $table = 'users_quizzes';
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];
}