@extends('templates.layout')
@section('title', $title)
@section('content')
    <h1>{{$title}}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>CREATED DATE</th>
                <th>TITLE</th>
                <th>THUMBNAIL</th>
                <th></th>
            </tr>
        </thead>
        @foreach($photos as $photo)
        <tr>
            <td>{{$photo->id}}</td>
            <td>{{$photo->created_at}}</td>
            <td>{{$photo->name}}</td>
            <td><img width="120px" src="{{asset($photo->img_path)}}"></td>
            <td>
                <a href="{{route('photos.edit',$photo->id)}}" class="btn btn-primary">UPDATE</a>
                <a href="{{route('photos.destroy',$photo->id)}}" class="btn btn-danger">DELETE</a>
            </td>
        </tr>
        @endforeach
    </table>
@stop
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('tr').on('click', 'a.btn-danger', function (ele) {
                ele.preventDefault();
                var urlPhoto = $(this).attr('href');
                var tr = ele.target.parentNode.parentNode;
                $.ajax(urlPhoto,
                    {
                        method:'DELETE',
                        data: {
                            '_token' : '{{csrf_token()}}'
                        },
                        complete:function (resp) {
                            console.log(resp.responseText);
                            if(resp.responseText ==1) {
                                $(tr).remove();
                            } else {
                                alert('Problemi con la cancellazione')
                            }
                        }
                    })
            })
        });
    </script>
@stop
