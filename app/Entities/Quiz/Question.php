<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Base\TranslatableModel;
use App\Entities\Callout;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends TranslatableModel
{
    protected $fillable = [ 'content' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];
    protected $translatable = [ 'content' ];

    public function answer() : BelongsTo
    {
        return $this->belongsTo(Callout::class, 'questions_answers');
    }
}