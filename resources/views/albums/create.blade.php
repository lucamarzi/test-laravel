@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    <form action="{{route('save_album')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="album_name">Name</label>
            <input type="text" class="form-control" name="album_name" id="album_name" placeholder="Album name">
        </div>
        <div class="form-group">
            <label for="album_name">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop