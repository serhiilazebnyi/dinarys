<?php

namespace App\Repositories\Eloquent;

use App\Task;
use App\Project;
use App\Repositories\TaskRepositoryInterface;

class TaskRepository extends AbstractRepository implements TaskRepositoryInterface
{
    /**
     * Task model
     * @var App\Task
     */
    protected $task;

    /**
     * Create a TaskRepository new instance
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Creates a new task
     * @param  int $projectId
     * @return void
     */
    public function newTask(int $projectId)
    {
        $task = $this->task;
        $priority = $this->task
            ->where('project_id', $projectId)
            ->max('priority');

        $task->project_id = $projectId;
        $task->description = 'New task';
        $task->deadline = date('Y-m-d');
        $task->priority = $priority++;

        $task->save();
    }

    /**
     * Updates a task
     * @param  int $id
     * @param array $data
     * @return void
     */
    public function updateTask(int $id, array $data)
    {
        $task = $this->task->find($id);
        $row = $data['row'];
        $task->$row = e($data['value']);

        $task->save();
    }

    /**
     * Changes task status
     * @param  int $id
     * @return void
     */
    public function switchTaskStatus(int $id)
    {
        $task = $this->task->find($id);
        $task->is_done = !$task->is_done;
        $task->save();
    }

    /**
     * Changes task priority
     * @param  int $id
     * @param  int $priority
     * @return void
     */
    public function changeTaskPriority(int $id, int $priority)
    {
        $task = $this->task->find($id);

        $projectId = $task->project_id;
        $priorityBefore = $task->priority;

        if ($priority < $priorityBefore) {
            $this->task
                ->where('project_id', $projectId)
                ->where('priority', '<', $priorityBefore)
                ->where('priority', '>=', $priority)
                ->increment('priority');
        }
        else {
            $this->task
                ->where('project_id', $projectId)
                ->where('priority', '>', $priorityBefore)
                ->where('priority', '<=', $priority)
                ->decrement('priority');
        }

        $task->update(['priority' => $priority]);
    }

    /**
     * Deletes task
     * @param  int $id
     * @return void
     */
    public function deleteTask(int $id)
    {
        $task = $this->task->find($id);

        $projectId = $task->project_id;
        $priority = $task->priority;

        $this->task
            ->where('project_id', $projectId)
            ->where('priority', '>', $priority)
            ->decrement('priority');

        $task->delete();
    }
}
