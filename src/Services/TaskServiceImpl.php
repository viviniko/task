<?php

namespace Viviniko\Task\Services;

use Viviniko\Task\Contracts\TaskCommandManager;
use Viviniko\Task\Contracts\TaskService as TaskServiceInterface;
use Viviniko\Task\Repositories\Log\LogRepository;
use Viviniko\Task\Repositories\Task\TaskRepository;
use Viviniko\Task\Runable;
use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class TaskServiceImpl implements TaskServiceInterface
{
    /**
     * @var \Viviniko\Task\Repositories\Task\TaskRepository
     */
    protected $taskRepository;

    /**
     * @var \Viviniko\Task\Repositories\Log\LogRepository
     */
    protected $logRepository;

    /**
     * @var \Viviniko\Task\Contracts\TaskCommandManager
     */
    protected $taskCommandManager;

    public function __construct(TaskRepository $taskRepository, LogRepository $logRepository, TaskCommandManager $taskCommandManager)
    {
        $this->taskRepository = $taskRepository;
        $this->logRepository = $logRepository;
        $this->taskCommandManager = $taskCommandManager;
    }

    public function getTaskCommands()
    {
        return $this->taskCommandManager->getTaskCommands();
    }

    public function getTaskByCommand($command)
    {
        return $this->taskRepository->findByCommand($command);
    }

    public function updateTask($taskId, array $data)
    {
        return $this->taskRepository->update($taskId, $data);
    }

    public function log($taskId, array $data = [])
    {
        $task = $this->taskRepository->find($taskId);
        $data = array_merge([
            'task_id' => $task->id,
            'message' => $task->message,
            'start_time' => $task->start_time,
            'end_time' => $task->end_time,
            'level' => 'info',
        ], $data);
        if (!empty($data['message'])) {
            $this->logRepository->create($data);
        }
    }

    public function make(Command $command)
    {
        return new Runable($this, $command);
    }

    public function schedule(Schedule $schedule)
    {
        try {
            foreach($this->taskRepository->all() as $task) {
                if ($task->is_active)
                    $schedule->command($task->command)->cron($task->cron)->timezone($task->timezone);
            }
        } catch (\Exception $e) {
            // ignore
        }
    }

    public function commands()
    {
        $commands = $this->taskCommandManager->getTaskCommands()->pluck('class');
        Artisan::starting(function ($artisan) use ($commands) {
            foreach ($commands as $command) {
                $artisan->resolve($command);
            }
        });
    }

}