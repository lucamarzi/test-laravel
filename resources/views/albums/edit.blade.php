@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    <form action="/albums/{{$album->id}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="album_name">Name</label>
            <input type="text" class="form-control" name="album_name" id="album_name" placeholder="Album name" value="{{$album->album_name}}">
        </div>
        <div class="form-group">
            <label for="album_name">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description">{{$album->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop