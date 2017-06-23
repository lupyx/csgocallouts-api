<?php
// Created by lupix. All rights reserved.

namespace App\Traits;
use Illuminate\Support\Facades\Log;

/**
 * Class HasStorage
 * @package App\Traits
 * Adds methods to classes that have a name property to make it easier to access its storage folders
 * It will look for a folder 'plural-of-classname/name-property-of-object' within the 'app' storage folder
 * The 'name-property-of-object' part will be trimmed and decapitalized
 */
trait HasStorage
{
    /**
     * @return string The directory of the model's storage folder
     */
    public function getStorageDirectory() : string
    {
        // Get the plural form of the decapitalized class name
        $classPlural = str_plural(strtolower(class_basename($this)));

        /**
         * We must make sure that retrieving the property 'name' does not give an error when we are using this trait on
         * a class that doesn't have a 'name' property
         */
        try
        {
            $objectName = ((object) ($this))->name;
            return storage_path('app/' . $classPlural . '/' . $objectName . '/');
        }
        catch (\Exception $e)
        {
            Log::warning("Attempted to retrieve name property of an object that doesn't have it");
            return '';
        }
    }
}