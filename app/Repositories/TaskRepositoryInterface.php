<?php

namespace App\Repositories;

use App\Task;
use App\Project;

interface TaskRepositoryInterface
{
    /**
     * Creates a new task
     * @param  int $projectId
     * @return void
     */
    public function newTask(int $projectId);

    /**
     * Updates a task
     * @param  int $id
     * @param array $data
     * @return void
     */
    public function updateTask(int $id, array $data);

    /**
     * Changes task status
     * @param  int $id
     * @return void
     */
    public function switchTaskStatus(int $id);

    /**
     * Changes task priority
     * @param  int $id
     * @param  int $priority
     * @return void
     */
    public function changeTaskPriority(int $id, int $priority);

    /**
     * Deletes task
     * @param  int $id
     * @return void
     */
    public function deleteTask(int $id);
}
