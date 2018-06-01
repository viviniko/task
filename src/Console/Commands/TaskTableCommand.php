<?php

namespace Viviniko\Task\Console\Commands;

use Viviniko\Support\Console\CreateMigrationCommand;

class TaskTableCommand extends CreateMigrationCommand
{
    /**
     * @var string
     */
    protected $name = 'task:table';

    /**
     * @var string
     */
    protected $description = 'Create a migration for the task service table';

    /**
     * @var string
     */
    protected $stub = __DIR__.'/stubs/task.stub';

    /**
     * @var string
     */
    protected $migration = 'create_task_table';
}
