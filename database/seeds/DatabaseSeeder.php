<?php

use App\User;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Album::truncate();
        Photo::truncate();
        $this->call(UsersTableSeeder::class);
        $this->call(AlbumTableSeeder::class);
        $this->call(PhotoTableSeeder::class);
    }
}
