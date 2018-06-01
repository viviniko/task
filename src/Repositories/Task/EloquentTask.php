<?php

namespace Viviniko\Task\Repositories\Task;

use Viviniko\Repository\SimpleRepository;

class EloquentTask extends SimpleRepository implements TaskRepository
{
    protected $modelConfigKey = 'task.task';

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->createModel()->newQuery()->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findByCommand($command)
    {
        return $this->createModel()->newQuery()->where('command', $command)->first();
    }
}