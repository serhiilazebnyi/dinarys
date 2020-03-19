@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>INFO</h1>
                <ul>
                    <li>Click 'New project' button to create new project.</li>
                    <li>To edit project's title click on it. Click trash icon to delete project.</li>
                    <li>Click 'New task' to create new task for parent project.</li>
                    <li>To edit task click on it's description or deadline date.</li>
                    <li>Click status button to mark task as done/undone.</li>
                    <li>Grab and drag list icon to change task priority in list.</li>
                    <li>Click trash button to delete task.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
