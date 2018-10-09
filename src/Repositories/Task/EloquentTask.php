<?php

namespace Viviniko\Task\Repositories\Task;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentTask extends EloquentRepository implements TaskRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('task.task'));
    }

    /**
     * {@inheritdoc}
     */
    public function findByCommand($command)
    {
        return $this->findBy('command', $command);
    }
}