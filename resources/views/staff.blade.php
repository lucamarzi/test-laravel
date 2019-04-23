@extends('templates.layout')
@section('title', $title)
@section('content')
<h1>{{$title}}</h1>

@if($staff)
    <ul>
        @foreach ($staff as $person)
            <li style="{{$loop->first ? 'color:red':''}}"> {{$loop->iteration}} - {{$person['lastname']}} {{$person['name']}}</li>
        @endforeach
    </ul>
@endIf
{{--    <ul>--}}
{{--    @forelse($staff as $person)--}}
{{--        <li>{{$person['lastname']}} {{$person['name']}}</li>--}}
{{--    @empty--}}
{{--        <li>No Staff</li>--}}
{{--    @endforelse--}}
{{--    </ul>--}}
@endsection