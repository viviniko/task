<?php

namespace Viviniko\Task\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Task extends Model
{
    protected $tableConfigKey = 'task.tasks_table';

    protected $fillable = [
        'command', 'cron', 'timezone', 'options', 'is_log', 'is_active', 'is_running', 'data', 'message', 'start_time', 'end_time', 'description', 'mode',
    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
        'is_running' => 'boolean',
        'is_log' => 'boolean',
    ];
}