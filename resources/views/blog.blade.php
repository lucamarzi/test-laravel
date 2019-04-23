@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    @component('components.card',
        [
            'img_title' => 'Image Blog',
            'img_url' => 'http://lorempixel.com/400/200'
        ]
    )
        <p>This is a test image</p>
    @endcomponent
@endsection
