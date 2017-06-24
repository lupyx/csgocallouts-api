<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Auth;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SteamSession extends Model
{
    protected $table = 'steam_sessions';

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }
}