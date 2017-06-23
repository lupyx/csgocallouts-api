<?php
// Created by lupix. All rights reserved.

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 * @package App\Entities
 * The entity that holds map information such as callouts
 */
class Map extends Model
{

    protected $fillable = [ 'name' ];

    public static $validation_rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Will return the callouts belonging to this map
     */
    public function callouts()
    {
        return $this->belongsToMany(Callout::class);
    }
}