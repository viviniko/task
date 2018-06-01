<?php

namespace Viviniko\Task\Repositories\Log;

use Viviniko\Repository\SimpleRepository;

class EloquentLog extends SimpleRepository implements LogRepository
{
    protected $modelConfigKey = 'task.log';

    public function paginate($perPage, $search = [])
    {
        return $this->search($search)->orderBy('start_time', 'desc')->paginate($perPage);
    }
}