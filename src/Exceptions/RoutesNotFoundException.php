<?php

namespace LaravelAdmin\Exceptions;

use Exception;

class RoutesNotFoundException extends Exception
{
    /**
     * RoutesNotFoundException constructor.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}