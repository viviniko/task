<?php

namespace Viviniko\Task\Facades;

use Illuminate\Support\Facades\Facade;

class Task extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'task';
    }
}