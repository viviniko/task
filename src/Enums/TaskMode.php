<?php

namespace Viviniko\Task\Enums;

class TaskMode
{
    const MULTI = '0';
    const SINGLE = '1';

    public static function values()
    {
        return [
            self::MULTI => 'Multi',
            self::SINGLE => 'Single',
        ];
    }
}