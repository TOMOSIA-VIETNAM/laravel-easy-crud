<?php

namespace VietNH\LaraEasyDev\Helpers;

use ReflectionClass;
use Illuminate\Support\Facades\Schema;

class ModelHelper
{
    /**
     * @param string $model
     * @return string
     */
    public static function getModelPath(string $model): string
    {
        return sprintf(
            '%s\%s',
            config('crud.generator.paths.app_model'),
            $model
        );
    }

    /**
     * @param string $model
     * @return array
     * @throws \ReflectionException
     */
    public static function getFillable(string $model): array
    {
        $modelClass = ModelHelper::getModelPath($model);
        $reflectionClass = new ReflectionClass($modelClass);
        $fillableProperty = $reflectionClass->getProperty('fillable');
        $fillableProperty->setAccessible(true);
        return $fillableProperty->getValue(new $modelClass);
    }
}
