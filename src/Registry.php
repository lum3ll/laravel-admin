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
     * @param  mixed  $model
     *
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function add($model)
    {
        if (!$model instanceof Model) {
            throw new InvalidArgumentException("Expected Eloquent model.");
        }

        array_push(static::$models, $model);
    }

    /**
     * Retrieve a model.
     *
     * @param string $model
     *
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function get($model)
    {
        if (isset(static::$models[$model])) {
            return static::$models[$model];
        }

        throw new InvalidArgumentException("Model $model not found.");
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