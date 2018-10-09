<?php

namespace Viviniko\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Task extends Model
{
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('task.tasks_table');
    }
}