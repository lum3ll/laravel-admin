<?php

namespace LaravelAdmin;

use Illuminate\Database\Eloquent\Model;

class Registry
{
    /**
     * @var array
     */
    private static $models = [];

    /**
     * Register a new eloquent model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public static function add(Model $model)
    {
        array_push(static::$models, $model);
    }

    /**
     * Retrieve all backends.
     *
     * @return array
     */
    public static function all()
    {
        return static::$models;
    }
}