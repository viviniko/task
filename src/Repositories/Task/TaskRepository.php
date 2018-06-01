<?php

namespace Viviniko\Task\Repositories\Task;

interface TaskRepository
{
    /**
     * Get all tasks.
     *
     * @return mixed
     */
    public function all();

    /**
     * Find task by its id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Find Task by command.
     *
     * @param $command
     * @return mixed
     */
    public function findByCommand($command);

    /**
     * Create new task.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update task specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete task with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);
}