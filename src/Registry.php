<?php

namespace LaravelAdmin;

use InvalidArgumentException;
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
     * @param  string  $key
     * @param  mixed  $value
     *
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function add($key, $value)
    {
        if (!$value instanceof Model) {
            throw new InvalidArgumentException("Expected Eloquent model.");
        }

        static::$models[$key] = $value;
    }

    /**
     * Retrieve a model.
     *
     * @param string $key
     *
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function get($key)
    {
        if (isset(static::$models[$key])) {
            return static::$models[$key];
        }

        throw new InvalidArgumentException("Model $key not found.");
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