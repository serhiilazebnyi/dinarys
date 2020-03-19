<?php

namespace App\Repositories;

use App\Project;
use App\User;

interface ProjectRepositoryInterface
{
    /**
     * Finds all projects for the given user
     * @param  User   $user
     * @return [type] [description]
     */
    public function findProjectsForUser(User $user);

    /**
     * Creates a new project
     * @return void
     */
    public function createProject();

    /**
     * Updates a project name
     * @param  int    $id
     * @param  string $name
     * @return void
     */
    public function updateProjectName(int $id, string $name);

    /**
     * Deletes project
     * @param  int    $id
     * @return void
     */
    public function deleteProject(int $id);
}
