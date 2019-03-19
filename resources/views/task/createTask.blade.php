@extends("templates.layoutTask")
@section("taskContent")
<div class="container">

    <h1>Create Task</h1>

    {{ Form::open(array('url' => 'task')) }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('status', 'Status') }}
        {{ Form::select('status', array('progress' => 'Progress', 'incomplete' => 'Incomplete', 'completed' => 'Completed'), 'progress', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('duration', 'Duration') }}
        {{ Form::text('duration', Input::old('duration'), array('class' => 'form-control')) }}
    </div>


    <div class="modal-footer">
        <a class="btn btn-default" href="{{URL::to('collections/')}}">Cancel</a>
        {{ Form::submit('Create task', array('class' => 'btn btn-primary')) }}
    </div>
    <input type="hidden" value="{{$collection_id}}" name="collection_id">
    {{ Form::close() }}

</div>
@endsection
