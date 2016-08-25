<?php

namespace LaravelAdmin;

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;

class Registry
{
    /**
     * @var array
     */
    private $models = [];

    /**
     * Register a new eloquent model.
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @throws \InvalidArgumentException
     * @return void
     */
    public function add($key, $value)
    {
        if (is_subclass_of($value, 'Model')) {
            throw new InvalidArgumentException('Expected an instance of a model.');
        }

        $this->models[$key] = $this->toObject($value);
    }

    /**
     * Retrieve a model.
     *
     * @param string $key
     *
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function get($key)
    {
        if (isset($this->models[$key])) {
            return $this->models[$key];
        }

        throw new InvalidArgumentException("Model $key not found.");
    }

    /**
     * Retrieve all backends.
     *
     * @return array
     */
    public function all()
    {
        return $this->models;
    }

    /**
     * Create an object from a namespace.
     *
     * @param  string  $namespace
     * @return mixed
     */
    private function toObject($namespace)
    {
        return new $namespace;
    }
}