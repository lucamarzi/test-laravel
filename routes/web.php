<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use App\Models\Album;
use App\Models\Photo;

Route::get('/', 'HomeController@index');

Route::get('/users', function(){
    return User::all();
});

Route::get('/albums', 'AlbumsController@index')->name('albums');
Route::get('/albums/{album}', 'AlbumsController@show')->where('album', '[0-9]+');
Route::get('/albums/create', 'AlbumsController@create')->name('create_album');
Route::post('/albums', 'AlbumsController@save')->name('save_album');
Route::get('/albums/{album}/edit', 'AlbumsController@edit');
Route::patch('/albums/{id}', 'AlbumsController@store');
Route::delete('/albums/{album}', 'AlbumsController@delete')->where('album', '[0-9]+');

Route::get('/albums/{album}/photos', 'AlbumsController@getPhotos')->name('album_photos')->where('album', '[0-9]+');

Route::get('usersnoalbums', function(){
   return DB::table('users as u')
       ->leftJoin('albums as a', 'a.user_id', 'u.id')
       ->select('u.name','u.email', 'u.id')
       ->whereNull('a.album_name')
       ->get();
});

Route::resource('photos', 'PhotosController');


Route::get('/{name?}/{lastname?}/{age?}', 'WelcomeController@welcome')->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{1,3}'
]);
