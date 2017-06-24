<?php
// Created by lupix. All rights reserved.

namespace App\Entities\Quiz;

use App\Entities\Callout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    protected $fillable = [ 'content' ];
    protected $hidden = [ 'pivot', 'created_at', 'updated_at' ];

    /**
     * @param string $locale The language identifier
     * @return bool Does a translation for in the specified language exist?
     * Will return whether or not there is a translation for the specified locale
     */
    public function hasTranslation(string $locale, Connection $connection) : bool
    {
        $translation = $connection->table('questions_localisations')->where([
            'quiz_id' => $this->id,
            'lang' => $locale
        ])->get();

        return !is_null($translation);
    }

    /**
     * @param string $locale The language identifier
     * Will replace the title of the quiz with the translated version
     */
    public function translate(string $locale, Connection $connection) : void
    {
        $translation = $connection->table('questions_localisations')->where([
            'quiz_id' => $this->id,
            'lang' => $locale
        ])->first('title');

        $this->title = $translation;
    }

    public function answer() : HasOne
    {
        return $this->hasOne(Callout::class, 'questions_answers');
    }
}