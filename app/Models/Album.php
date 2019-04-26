<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Album extends Model {
    protected $fillable = ['album_name', 'description', 'user_id'];

    public function getPathAttribute() {
        $url = $this->album_thumb;
        if(stristr($url, 'http')===false) {
            $url = 'storage/'.$this->album_thumb;
        }
        return $url;
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }
}