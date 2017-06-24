<?php
// Created by lupix. All rights reserved.

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Map
 * @package App\Entities
 * The entity that holds map information such as callouts
 */
class Map extends Model
{
    protected $fillable = [ 'name' ];
    protected $hidden = [ 'created_at', 'updated_at' ];

    /**
     * @return BelongsToMany
     * Will return the callouts belonging to this map
     */
    public function callouts() : BelongsToMany
    {
        return $this->belongsToMany(Callout::class, 'maps_callouts');
    }
}