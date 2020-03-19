$(document).ready(function(e) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if (window.location.pathname == '/projects') {

        var projectsSelector = $('div#projects');

        getProjects();

        // Create new project
        projectsSelector.on('click', 'button[name="add-project"]', function(){
            newProject();
        });

        // Create new task
        projectsSelector.on('click', 'button[name="add-task"]', function(){
            var projectId = $(this).parents().eq(2).find('.project').attr('id');
            newTask(projectId);
        });

        // Delete task
        projectsSelector.on('click', 'button[name="delete-task"]', function(){
            $(this).on('click', deleteTask($(this)));
        });

        // Change task status
        projectsSelector.on('click', 'button[name="status-task"]', function(){
            switchStatus($(this));
        });

        // Update task
        projectsSelector.on('click', 'button[name="save-task"]', function(){
            saveTask($(this));
        });

        // Enable contenteditable on elements with class .contenteditable by click
        projectsSelector.on('click', '.contenteditable', function(){
            $(this).attr('contenteditable', 'true');
        });

        // Update project title
        projectsSelector.on('focusout', '.project-title', function(){
            updateProject($(this));
        });

        projectsSelector.on('focusout', '.task-description', function(){
            updateTask($(this), 'description', $(this).text());
        });

        projectsSelector.on('change', 'input[name="deadline"]', function(){
            updateTask($(this), 'deadline', $(this).val());
        });

        // Delete project
        projectsSelector.on('click', 'span.delete-project', function(){
            deleteProject($(this));
        });
    }

});

// Get all projects for user
function getProjects() {
    $.ajax({
        url: '/user-projects',
        success: function(data) {
            $('div#projects').html(data);
        }
    });
}

// Create new project
function newProject() {
    $.ajax({
        url: '/projects',
        type: 'post',
        success: function() {
            getProjects();
        }
    });
}

// Update project
function updateProject(input) {
    var id = input.parent().attr('id');
    var data = {};

    data._method = 'PATCH';
    data.name = input.text();

    $.ajax({
        url: '/project/' + id,
        type: 'post',
        data: data,
        success: function(data) {
            getProjects();
        }
    });
}

// Delete project
function deleteProject(input) {
    var id = input.parent().attr('id');

    $.ajax({
        url: '/project/' + id,
        type: 'post',
        data: {_method: 'DELETE'},
        success: function(data) {
            getProjects();
        }
    });
}

// Create task
function newTask(projectId) {
    $.ajax({
        url: '/task',
        type: 'post',
        data: {projectId: projectId},
        success: function() {
            getProjects();
        }
    });
}

// Update task
function updateTask(input, row, value) {
    var taskId = input.parents('tr').attr('id');
    var data = {};

    data._method = 'PATCH';
    data.row = row;
    data.value = value;

    $.ajax({
        url: '/task/' + taskId,
        type: 'post',
        data: data,
        success: function() {
            getProjects();
        },
        error: function(data) {
            console.log(data);
        }
    });
}

// Change task status
function switchStatus(button) {
    var id = button.parents('tr').attr('id');
    var data = {};

    data._method = 'PATCH';

    $.ajax({
        url: '/task/status/' + id,
        type: 'post',
        data: data,
        success: function(data) {
            getProjects();
        }
    });
}

// Delete task
function deleteTask(button) {
    var id = button.parents('tr').attr('id');
    var data = {};

    data._method = 'DELETE';

    $.ajax({
        url: '/task/' + id,
        type: 'post',
        data: data,
        success: function(data) {
            getProjects();
        }
    });
}
