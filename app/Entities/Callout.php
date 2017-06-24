<?php
// Created by lupix. All rights reserved.

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Callout
 * @package App\Entities
 * The callout belonging to one or more maps
 */
class Callout extends Model
{
    protected $fillable = [ 'name' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * The maps the callout belongs to
     */
    public function maps() : BelongsToMany
    {
        return $this->belongsToMany(Map::class);
    }
}