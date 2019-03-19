@extends("templates.layout")
@section("content")

<div class="container">
    <h2>{{$collection->title}}</h2>
    <p>{{$collection->description}}</p>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" id="status" onkeyup="statusFilter()" placeholder="Filter on status.."
                title="Type a task">
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" id="duration" onkeyup="durationFilter()" placeholder="Filter on duration.."
                title="Type a task">
        </div>
    </div>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th onclick="sortTable(2)">Status</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collection->tasks as $task)
            <tr>
                <td>{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>{{$task->status}}</td>
                <td class="taskActions" style="width: 20%;">
                    {{$task->duration}}
                    <span style="float: right; padding-right: 15px;"><a href="{{URL::to('task/'. $task->id . '/edit' )}}"
                            style="color:#3490DC"><i class="fas fa-pencil-alt"></i></a></span>
                    {{ Form::model($task, array('route' => array('task.destroy', $task->id),'method' =>'DELETE')) }}
                    <span class="DltICon" style="float: right; padding-right: 15px;"><button type="submit" value="Delete"
                            class=" trashIcon btn btn-link float-right"><i class="fas fa-trash-alt"></i></button></span>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{URL::to('task/create/' . $collection->id)}}" class="btn btn-outline-secondary btn-lg btn-block">ADD TASK</a>
</div>


@endsection
