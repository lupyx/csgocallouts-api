<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;

abstract class TranslatableModel extends Model
{
    protected $translatable = [];

    public function hasTranslation(string $locale, Connection $connection) : bool
    {
        $className = strtolower(class_basename($this));

        $translation = $connection->table($this->table . '_localisations')->where([
            $className . '_id' => $this->id,
            'lang' => $locale
        ])->get();

        return !is_null($translation);
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