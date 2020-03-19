<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{
    /**
     * Task repository
     * @var App\Repositories\TaskRepositoryInterface
     */
    protected $task;

    /**
     * Create a new TaskController instance
     * @param TaskRepositoryInterface $task
     */
    public function __construct(TaskRepositoryInterface $task)
    {
        $this->task = $task;
    }

    /**
     * Creates a new task
     * @param  Request $request
     * @return void
     */
    public function newTask(Request $request)
    {
        $this->task->newTask($request->projectId);
    }

    /**
     * Updates a task
     * @param  int  $id
     * @param  Request $request
     * @return void
     */
    public function updateTask($id, Request $request)
    {
        $data = [
            'row'   => $request->row,
            'value' => $request->value
        ];

        $this->task->updateTask($id, $data);
    }

    /**
     * Changes task status
     * @param  int $id
     * @return void
     */
    public function switchTaskStatus($id)
    {
        $this->task->switchTaskStatus($id);
    }

    /**
     * Changes task priority
     * @param  int  $id
     * @param  Request $request
     * @return void
     */
    public function changeTaskPriority($id, Request $request)
    {
        $priority = $request->priority;
        $this->task->changeTaskPriority($id, $priority);
    }

    /**
     * Deletes a task
     * @param  int $id
     * @return void
     */
    public function deleteTask($id)
    {
        $this->task->deleteTask($id);
    }
}
