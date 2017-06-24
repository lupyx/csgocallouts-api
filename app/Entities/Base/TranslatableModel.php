<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

abstract class TranslatableModel extends Model
{
    protected $translatable = [];
    protected $className;

    public function hasTranslation(string $locale, Connection $connection) : bool
    {
        return $connection->table($this->table . '_localisations')->where([
            $this->className . '_id' => $this->id,
            'lang' => $locale
        ])->exists();
    }

    /**
     * @param string $locale The language identifier
     * Will replace any properties in translatable with the translated ones
     */
    public function translate(string $locale, Connection $connection) : void
    {
        $className = strtolower(class_basename($this));

        $translation = $connection->table($this->table . '_localisations')->where([
            $className . '_id' => $this->id,
            'lang' => $locale
        ])->first($this->translatable);

        foreach($this->translatable as $property)
            $this->$property = $translation[$property];
    }
}