<?php

namespace Viviniko\Task;

use Carbon\Carbon;
use Closure;
use Viviniko\Task\Contracts\TaskService;
use Viviniko\Task\Models\Task;
use Illuminate\Console\Command;

class Runable
{
    /**
     * @var \Viviniko\Task\Models\Task
     */
    public $task;

    /**
     * @var array
     */
    public $options;

    /**
     * @var \Viviniko\Task\Contracts\TaskService;
     */
    protected $taskService;

    /**
     * @var \Illuminate\Console\Command
     */
    protected $command;

    public function __construct(TaskService $taskService, Command $command)
    {
        $this->taskService = $taskService;
        $this->command = $command;
        $this->task = $this->taskService->getTaskByCommand($this->command->getName());
        $this->options = $this->parseOptions($this->task);
    }

    public function run(Closure $closure)
    {
        if ($this->task->is_running) {
            $this->taskService->updateTask($this->task->id, ['message' => 'Task is running.']);
            return;
        }

        $message = 'Ok';
        try {
            $this->taskService->updateTask($this->task->id, ['start_time' => new Carbon, 'end_time' => null, 'is_running' => true]);
            $message = $closure($this);
            if ($message && !is_string($message)) {
                $message = @serialize($message);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        } finally {
            $this->taskService->updateTask($this->task->id, ['is_running' => false, 'end_time' => new Carbon, 'message' => $message]);
            if ($this->task->is_log) $this->taskService->log($this->task->id);
        }
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function setCommand(Command $command)
    {
        $this->command = $command;
        return $this;
    }

    protected function parseOptions(Task $task)
    {
        return array_reduce(explode("\n", $task->options), function ($config, $option) {
            if (strpos($option, ':') !== false) {
                list ($k, $v) = explode(':', $option, 2);
                $config[trim($k)] = trim($v);
            }
            return $config;
        }, []);
    }
}