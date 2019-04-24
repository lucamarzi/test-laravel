@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    @if(session()->has('msg'))
    @component('components.alert-info')
        {{session()->get('msg')}}
    @endcomponent
    @endif
    @if(count($albums)>0)
    <form>
    <input type="hidden" name="_token"  id="_token" value="{{csrf_token()}}">
    <ul class="list-group">
    @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                {{$album->id}} - {{$album->album_name}}
                @if($album->album_thumb)
                    <img width="300" src="{{$album->album_thumb}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
                @endif
                <div>
                    <a href="/albums/{{$album->id}}/edit" class="btn btn-primary">UPDATE</a>
                    <a href="/albums/{{$album->id}}" class="btn btn-danger delete">DELETE</a>
                </div>
            </li>
     @endforeach
    </ul>
    </form>
    @else
    Non ci sono albums
    @endif
@endsection
@section('footer')
@parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(3000);
            $('ul').on('click', '.delete', function (ele) {
                ele.preventDefault();
                var urlAlbum = $(this).attr('href');
                var li = ele.target.parentNode.parentNode;
                $.ajax(urlAlbum,
                    {
                        method:'DELETE',
                        data: {
                          '_token' : $("#_token").val()
                        },
                        complete:function (resp) {
                            if(resp.responseText ==1) {
                                $(li).remove();
                            } else {
                                alert('Problemi con la cancellazione')
                            }
                        }
                    })
            })
        });
    </script>
@endsection
