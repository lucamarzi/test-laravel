<div class="form-group">
    <label for="album_thumb">Album thumb</label>
    <input type="file" class="form-control" name="album_thumb" id="album_thumb" placeholder="Album Thumb">
</div>
@if($album->album_thumb)
    <div class="form-group">
        <img src="{{asset($album->path)}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
    </div>
@endif
