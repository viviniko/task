<?php

namespace Viviniko\Task\Contracts;

use Illuminate\Support\Collection;

interface TaskCommandManager
{
    /**
     * Get all task commands.
     *
     * @return Collection
     */
    public function getTaskCommands();
}