<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Album extends Model {
    protected $fillable = ['album_name', 'description', 'user_id'];
}