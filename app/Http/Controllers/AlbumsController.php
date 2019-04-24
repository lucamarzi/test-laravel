<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;

class AlbumsController extends Controller
{
    //
    public function  index(Request $request) {
        //$queryBuilder = DB::table('albums')->orderBy('id', 'desc');
        $queryBuilder = Album::orderBy('id', 'desc');
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

    public function show($id) {
        return DB::table('albums')->where('id', $id)->get();
    }

    public function create() {
        return view('albums.create')->with('title', 'Insert New Album');
    }

    public function save(Request $req) {
        $album = new Album();
        $album->album_name = $req['album_name'];
        $album->description = $req['description'];
        $album->user_id = 1;
        $res = $album->save();
        $msg = $res ? 'Album name '.$req['album_name'].' Created' : 'Album '.$req['album_name'].' not created';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public  function edit($id) {
        $title = "Edit Album";
        $album = Album::find($id);
        return view('albums.edit', compact('title', 'album'));
    }

    public function  store($id, Request $req) {
        $album = Album::find($id);
        $album->album_name = $req['album_name'];
        $album->description = $req['description'];
        $res = $album->save();
        $msg = $res ? 'Album id = '.$id.' Aggiornato' : 'Album non aggiornato';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function delete($id) {
        $res = Album::find($id)->delete();
        return ''.$res;
    }
}
