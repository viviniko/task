<?php

namespace Viviniko\Task\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    protected $tableConfigKey = 'task.logs_table';

    protected $fillable = [
        'task_id', 'message', 'start_time', 'end_time', 'level',
    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];
}