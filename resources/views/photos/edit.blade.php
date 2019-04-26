@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    <form action="{{route('photos.update', $photo->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="name">Photo name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="H name" value="{{$photo->name}}">
        </div>
        @include('photos.partials.fileupload')
        <div class="form-group">
            <label for="album_name">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description">{{$photo->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop