<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;

class AlbumsController extends Controller
{
    //
    public function  index(Request $request) {
        //return Album::all();
        $sql = 'select * from albums where 1=1 order by id desc';
        $where = [];
        if($request->has('id')) {
            $where['id'] = $request->get('id');
            $sql .= " AND id =:id";
        }
        if($request->has('album_name')) {
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name like concat('%', :album_name, '%') ";
        }

        $title = 'Albums';
        $albums = DB::select($sql, $where);
        return view('albums.albums', compact('title', 'albums'));
    }

    public function show($id) {
        $sql = "select * from albums where id=:id";
        return DB::select($sql, ['id'=>$id]);
    }

    public function create() {
        return view('albums.create')->with('title', 'Insert New Album');
    }

    public function save() {
        $data = request()->only(['album_name','description']);
        $data['user_id'] = 1;
        $sql = "insert into albums (album_name, description, user_id)";
        $sql .= " values (:album_name, :description, :user_id)";
        $res = DB::insert($sql, $data);
        $msg = $res ? 'Album name '.$data['album_name'].' Created' : 'Album '.$data['album_name'].' not created';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public  function edit($id) {
        $sql = "select id, album_name, description from albums where id=:id";
        $title = "Edit Album";
        $albums = DB::select($sql, ['id'=>$id]);
        $album = $albums[0];
        return view('albums.edit', compact('title', 'album'));
    }

    public function  store($id, Request $req) {
        $data = request()->only(['album_name', 'description']);
        $data['id'] = $id;
        $sql = "update albums set album_name=:album_name, description=:description where id =:id";
        $res = DB::update($sql, $data);
        $msg = $res ? 'Album id = '.$id.' Aggiornato' : 'Album non aggiornato';
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function delete($id) {
        $sql = "delete from albums where id=:id";
        return DB::delete($sql, ['id'=>$id]);
    }
}
