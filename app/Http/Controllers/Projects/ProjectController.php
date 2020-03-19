<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    /**
     * Project repository
     * @var App\Repositories\ProjectRepositoryInterface
     */
    protected $project;

    /**
     * Create a new ProjectController instance
     * @param ProjectRepositoryInterface $project
     */
    public function __construct(ProjectRepositoryInterface $project)
    {
        $this->project = $project;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * Retrieves projects for auth user
     * @return \Reponse
     */
    public function getUserProjects()
    {
        $projects = $this->project->findProjectsForUser(auth()->user());
        return view('projects.components.projects', compact('projects'));
    }

    /**
     * Updates project name
     * @param  int  $id
     * @param  Request $request
     * @return void
     */
    public function updateProjectName($id, Request $request)
    {
        $this->project->updateProjectName($id, $request->name);
    }

    /**
     * Deletes project
     * @param  int $id
     * @return void
     */
    public function deleteProject($id)
    {
        $this->project->deleteProject($id);
    }

    /**
     * Creates new project
     *
     * @return void
     */
    public function createProject()
    {
        $this->project->createProject();
    }
}
