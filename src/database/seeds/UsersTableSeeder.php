<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//        User::truncate();
//        Post::truncate();
        factory(User::class, 10)->create()->each(function($user){
            $user->posts()->save(factory(Post::class)->make());
        });
    }
}
