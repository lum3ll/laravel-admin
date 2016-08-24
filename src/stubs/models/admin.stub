<?php

namespace {{ namespace }};

use Auth;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The model table name.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * If a user has admin privelages.
     *
     * @return boolean
     */
    public function hasPrivelages()
    {
        $key = Auth::user()->getKeyName();

        $check = $this->where('user', Auth::user()->{$key})->first();

        return $check->count() > 0;
    }
}