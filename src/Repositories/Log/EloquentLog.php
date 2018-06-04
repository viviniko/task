<?php

namespace Viviniko\Task\Repositories\Log;

use Viviniko\Repository\SimpleRepository;

class EloquentLog extends SimpleRepository implements LogRepository
{
    protected $modelConfigKey = 'task.log';

}