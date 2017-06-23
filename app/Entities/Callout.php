<?php
// Created by lupix. All rights reserved.

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Callout
 * @package App\Entities
 * The callout belonging to one or more maps
 */
class Callout extends Model
{
    protected $fillable = [ 'name' ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * The maps the callout belongs to
     */
    public function map()
    {
        return $this->belongsToMany(Map::class);
    }
}