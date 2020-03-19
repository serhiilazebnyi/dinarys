<?php

namespace App\Repositories\Eloquent;

use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ProjectRepositoryInterface;

class ProjectRepository extends AbstractRepository implements ProjectRepositoryInterface
{
    /**
     * Project model
     * @var App\Project
     */
    protected $project;

    /**
     * Create ProjectRepository new instance
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Finds all projects for the given user
     * @param  User   $user
     * @return [type] [description]
     */
    public function findProjectsForUser(User $user)
    {
        $projects = $user->projects()->orderBy('created_at', 'DESC')
        ->with(['tasks' => function($query){
            $query->orderBy('priority', 'ASC');
        }])->get();

        return $projects;
    }

    /**
     * Creates a new project
     * @return void
     */
    public function createProject()
    {
        $project = $this->project;

        $project->user_id = auth()->user()->id;
        $project->name = 'New Project';
        $project->save();
    }

    /**
     * Updates a project name
     * @param  int    $id
     * @param  string $name
     * @return void
     */
    public function updateProjectName(int $id, string $name)
    {
        $project = $this->project->find($id);
        $project->update(['name' => $name]);
    }

    /**
     * Deletes project
     * @param  int    $id
     * @return void
     */
    public function deleteProject(int $id)
    {
        $project = $this->project->find($id);
        $project->tasks()->delete();
        $project->delete();
    }
}
