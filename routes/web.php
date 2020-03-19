<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/info', function(){
    return view('pages.info');
});

Route::group(['namespace' => 'Projects', 'middleware' => 'auth'], function() {
    /* PROJECTS ROUTES */
    Route::get('projects', 'ProjectController@index')->name('projects.index');
    Route::get('user-projects', 'ProjectController@getUserProjects')->name('projects.get');
    Route::post('projects', 'ProjectController@createProject');
    Route::patch('project/{id}', 'ProjectController@updateProjectName')->name('projects.edit');
    Route::delete('project/{id}', 'ProjectController@deleteProject')->name('projects.delete');

    /* TASKS ROUTES */
    Route::post('task', 'TaskController@newTask')->name('task.new');
    Route::patch('task/{id}', 'TaskController@updateTask')->name('task.update');
    Route::patch('task/status/{id}', 'TaskController@switchTaskStatus')->name('task.status');
    Route::patch('task/priority/{id}', 'TaskController@changeTaskPriority')->name('task.priority');
    Route::delete('task/{id}', 'TaskController@deleteTask')->name('task.delete');
});
