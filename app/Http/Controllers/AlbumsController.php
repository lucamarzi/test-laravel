<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Photo;
use Storage;

class AlbumsController extends Controller
{
    //
    public function  index(Request $request) {
        //$queryBuilder = DB::table('albums')->orderBy('id', 'desc');
        $queryBuilder = Album::orderBy('id', 'desc')->withCount('photos');
            if($request->has('id')) {
                $queryBuilder->where('id',  $request['id'] );
            }
        if($request->has('album_name')) {
            $queryBuilder->where('album_name', 'LIKE', '%'.$request['album_name'].'%');
        }
        $title = 'Albums';
        $albums = $queryBuilder->get();
        return view('albums.albums', compact('title', 'albums'));
    }

    public function show(Album $album) {
        //return DB::table('albums')->where('id', $id)->get();
        return $album;
    }

    public function create() {
        $title = 'Insert New Album';
        $album = new Album();
        return view('albums.create', compact('title', 'album'));
    }

    public function save(Request $req) {
        $album = new Album();
        $album->album_name = $req['album_name'];
        $album->description = $req['description'];
        $album->user_id = 1;
        $this->processFile($req, $album);
        $res = $album->save();
        $msg = $res ? 'Album name '.$req['album_name'].' Created' : 'Album '.$req['album_name'].' not created';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public  function edit(Album $album) {
        $title = "Edit Album";
        //$album = Album::find($id);
        return view('albums.edit', compact('title', 'album'));
    }

    public function  store($id, Request $req) {
        $album = Album::find($id);
        $album->album_name = $req['album_name'];
        $album->description = $req['description'];
        $this->processFile($req, $album);
        $res = $album->save();
        $msg = $res ? 'Album id = '.$id.' Aggiornato' : 'Album non aggiornato';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function delete(Album $album) {
        $thumbNail = $album->album_thumb;
        $disk = config('filesystems.default');
        $res = $album->delete();
        if($res) {
            if($thumbNail && Storage::disk($disk)->has($thumbNail)) {
                Storage::disk($disk)->delete($thumbNail);
            }
        }
        return '' .$res;
    }

    public function getPhotos(Album $album) {
        $photos = Photo::where('album_id', $album->id)->get();
        $title = $album->album_name.' Photos';
        return view('photos.albumphotos', compact('title','photos', 'album'));
    }

    /**
     * @param Request $req
     * @param Album $album
     */
    public function processFile(Request $req, Album $album): void
    {
        if ($req->hasFile('album_thumb')) {
            $file = $req->file('album_thumb');
            $filename = $file->store(env('ALBUM_THUMB_DIR'), 'public');
            $album->album_thumb = $filename;
        }
    }
}
