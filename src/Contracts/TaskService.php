<?php

namespace Viviniko\Task\Contracts;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;

interface TaskService
{
    /**
     * Get task.
     *
     * @param string $command
     * @return mixed
     */
    public function getTaskByCommand($command);

    /**
     * @return Collection
     */
    public function getTaskCommands();

    /**
     * Update task data.
     *
     * @param $taskId
     * @param array $data
     * @return mixed
     */
    public function updateTask($taskId, array $data);

    /**
     * Create log.
     *
     * @param $taskId
     * @param array $data
     * @return mixed
     */
    public function log($taskId, array $data = []);

    /**
     * Make runable task.
     *
     * @param Command $command
     * @return mixed
     */
    public function make(Command $command);

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule);

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    public function commands();
}