<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Auth;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SteamSession extends Model
{
    protected $table = 'steam_sessions';
    protected $fillable = [ 'user_id', 'token', 'expires' ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}