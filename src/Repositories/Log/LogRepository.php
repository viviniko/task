<?php

namespace Viviniko\Task\Repositories\Log;

use Viviniko\Repository\SearchRequest;

interface LogRepository
{
    /**
     * Search.
     *
     * @param SearchRequest $searchRequest
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function search(SearchRequest $searchRequest);

    /**
     * Find log by its id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create new log.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update log specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete log with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);
}