<?php

namespace Viviniko\Task\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class TaskTableCommand extends Command
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

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new notifications table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer    $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $path = $this->laravel->databasePath().'/migrations';

        $fullPath = $this->laravel['migration.creator']->create($this->migration, $path);

        $this->files->put($fullPath, $this->files->get($this->stub));

        $this->info('Migration created successfully!');

        $this->composer->dumpAutoloads();
    }
}
