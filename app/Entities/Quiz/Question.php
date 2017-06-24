<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Base\TranslatableModel;
use App\Entities\Callout;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends TranslatableModel
{
    protected $fillable = [ 'content' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];
    protected $translatable = [ 'content' ];

    public function answer() : HasOne
    {
        return $this->hasOne(Callout::class, 'questions_answers');
    }
}