<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env("APP_NAME")}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{URL::to('collections/')}}">TODO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Lists
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach($collections as $collection)
                        <a class="dropdown-item" href="{{URL::to('collections/' . $collection->id)}}">{{$collection->title}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a id="plus" class="nav-link" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></a>
                </li>
                <li class="nav-item">
                    <a id="plus" class="nav-link" data-toggle="modal" data-target="#preEditModal"><i class="far fa-edit"></i></a>
                </li>
                <li class="nav-item">
                    <a id="plus" class="nav-link" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- add list -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new list</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'collections')) }}
                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::text('description', Input::old('Description'), array('class' => 'form-control')) }}
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        {{ Form::submit('Create list', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete list -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete list</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($collections as $collection)
                    <ul class="listDlt">
                        {{ Form::model($collection, array('route' => array('collections.destroy', $collection->id), 'method' =>
                        'DELETE')) }}
                        <li><span style="margin-right: 15px;"><button type="submit" value="Delete" class="btn btn-link float-right">Delete</button></span>{{$collection->title}}</li>
                        {{ Form::close() }}
                    </ul>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Done</button>
                </div>
            </div>
        </div>
    </div>

    <!-- pre edit list -->
    <div class="modal fade" id="preEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">edit list</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($collections as $collection)
                    <ul class="listDlt">
                        <li><span class="float-right"><a href="{{ URL::to('collections/'. $collection->id . '/edit' )}}"
                                    style="color:#3490DC">edit</a></span>{{$collection->title}}</li>
                    </ul>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Done</button>
                </div>
            </div>
        </div>
    </div>

    @yield("content")
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
