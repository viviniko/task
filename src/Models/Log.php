<?php

namespace Viviniko\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Log extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'task_id', 'message', 'start_time', 'end_time', 'level',
    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('task.logs_table');
    }
}