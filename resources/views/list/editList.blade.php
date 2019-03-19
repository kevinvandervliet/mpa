@extends("templates.layout")
@section("content")
<div class="container">

    <h1>Edit {{ $collection->title }}</h1>

    {{ Form::model($collection, array('route' => array('collections.update', $collection->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('descripion', 'Description') }}
        {{ Form::text('description', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit list', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
@endsection
