<?php

namespace Viviniko\Task;

use Illuminate\Console\Command;

class TaskCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->laravel->make('task')->make($this)->run(function ($env) {
            return $this->runTask($env);
        });
    }

    public function runTask($env)
    {
        // todo..
    }

    public function toBoolean($value)
    {
        switch (strtolower(trim($value))) {
            case 'true':
            case '(true)':
            case '1':
            case 'yes':
            case 'y':
                return true;
        }

        return false;
    }
}