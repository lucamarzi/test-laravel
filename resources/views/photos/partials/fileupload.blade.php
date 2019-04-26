<div class="form-group">
    <label for="album_thumb">Photo</label>
    <input type="file" class="form-control" name="img_path" id="img_path" placeholder="Photo file">
</div>
@if($photo->img_path)
    <div class="form-group">
        <img src="{{asset($photo->path)}}" alt="{{$photo->name}}" title="{{$photo->name}}">
    </div>
@endif
