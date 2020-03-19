<div class="col-sm-12">
    <button class="btn btn-primary" type="button" name="add-project">
        New project
    </button>
    <div class="row">
        @foreach ($projects as $project)
            <div class="col-sm-12">
                <div class="card project-layout">
                  <div class="card-body">
                      <div class="project" id="{{ $project->id }}" >
                          <h3 title="Click to edit" class="project-title contenteditable">{{ $project->name }}</h3>
                          <span class="delete-project">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </span>
                      </div>
                      <ul>
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th><i class="fa fa-arrows" aria-hidden="true"></i></th>
                                      <th>Status</th>
                                      <th>Task</th>
                                      <th>Deadline</th>
                                      <th>Delete</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($project->tasks as $task)
                                      <tr class="sortable" id={{ $task->id }}>
                                          <td><i class="fa fa-list-ul" aria-hidden="true"></i></td>
                                          <td>
                                              @if ($task->is_done)
                                                  <button class="btn btn-success" type="button" name="status-task" value="0">
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                  </button>
                                              @else
                                                  <button class="btn btn-secondary" type="button" name="status-task" value="1">
                                                      <i class="fa fa-times" aria-hidden="true"></i>
                                                  </button>
                                              @endif

                                          </td>
                                          <td class="task-description contenteditable">{{ $task->description }}</td>
                                          <td class="task-deadline contenteditable">
                                              <input name="deadline" value="{{ $task->deadline }}">
                                          </td>
                                          <td>
                                              <button class="btn btn-danger" type="button" name="delete-task">
                                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                              </button>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                          <button class="btn btn-primary" type="button" name="add-task">
                              New task
                          </button>
                      </ul>
                  </div>
                </div>
            </div>
        @endforeach
        <script type="text/javascript">
            $('input[name="deadline"]').each(function(){
                $(this).datepicker({
                    dateFormat: 'yy-mm-dd',
                });
            });

            $('tbody').sortable({
                stop: function( event, ui ) {
                  var id = ui.item.attr('id');
                  var data = {};
                  var priority = ui.item.index() + 1;

                  data._method = 'PATCH';
                  data.priority = priority;

                  $.ajax({
                      url: '/task/priority/' + id,
                      type: 'post',
                      data: data,
                      success: function(data) {
                          console.log(data);
                      },
                      error: function(data) {
                          console.log(data);
                      }
                  });
              },
              cancel: ':input,button,.task-description,.task-deadline'
            });
        </script>
    </div>
</div>
