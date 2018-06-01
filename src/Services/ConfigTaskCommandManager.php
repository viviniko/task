<?php

namespace Viviniko\Task\Services;

use Viviniko\Task\Contracts\TaskCommandManager;
use Illuminate\Support\Collection;

class ConfigTaskCommandManager implements TaskCommandManager
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $taskCommands;

    public function __construct($commands = [])
    {
        $this->taskCommands = $this->parseTaskCommands($commands);
    }

    public function getTaskCommands()
    {
        return $this->taskCommands;
    }

    protected function parseTaskCommands($commands)
    {
        $taskCommands = new Collection([]);
        foreach ($commands as $command) {
            $instance = app($command);
            $taskCommands->push([
                'class' => $command,
                'command' => $instance->getName(),
                'name' => $instance->getDescription(),
            ]);
        }

        return $taskCommands;
    }
}