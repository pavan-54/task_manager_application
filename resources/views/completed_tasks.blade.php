@extends('app.master')
@section('content')
<div class="card">
    <center><h1>Welcome to Task Manager</h1></center>
    <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/task/completed_tasks">Completed Tasks</a>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Task
              </button>
          </li>
      </ul>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
                <th>Task Id</th>
                <th>Task Name</th>
                <th>Task Desciption</th>
                <th>Task Due Date</th>
                <th>Task Action</th>
            </tr>
          </thead>
          <tbody>
            @php
                $tasks = DB::table('tasks')->where('completed_on',"!=",null)->get();
            @endphp

            @foreach ($tasks  as $task)

            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->task_description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <select name="task_options" id="task_options">
                        <option value="">--</option>
                        <option value="edit">Edit Task</option>
                        <option value="delete">Delete Task</option>
                    </select>
                </td>
                <td>
                  <form action="/task/mark_un_complete/{{ $task->id }}" method="post">
                    @csrf
                    <input class="btn bg-danger" type="submit" value="Mark Un Complete">
                  </form>
                </td>
            </tr>
                
            @endforeach

          </tbody>
        </table>
      </div>
</div>
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/task/add_task" method="post">
            @csrf
                <div class="mb-4">
                  <label for="taskname" class="form-label">Task Name</label>
                  <input type="test" class="form-control" id="taskname" name="taskname">
                </div>
                <div class="mb-4">
                    <label for="taskdesc" class="form-label">Task Description</label>
                    <input type="test" class="form-control" id="taskdesc" name="taskdesc" aria-describedby="teskhelp">
                    <div id="teskhelp" class="form-text">The clear your message the clear your goal</div>
                  </div>
                <div class="mb-4">
                    <label class="form-label" for="taskdate">Task Due Date</label>
                    <input type="date" class="form-label" id="taskdate" name="taskdate">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#taskdate').val(new Date().toJSON().slice(0, 10)); // setting the date to today's date
  </script>

@endsection