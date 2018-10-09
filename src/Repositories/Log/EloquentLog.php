<?php

namespace Viviniko\Task\Repositories\Log;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentLog extends EloquentRepository implements LogRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('task.log'));
    }
}