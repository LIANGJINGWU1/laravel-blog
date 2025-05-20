<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $user = User::first();
        $userId = $user->id;;

        // 获取去除用户id为1的所有用户id的数组
        $followers = $users->slice(1);
        $followerIds = $followers->pluck('id')->toArray();
        //用户1关注其他用户
        $user->follow($followerIds);
        //除了1，所有人关注1
        foreach ($followers as $follower) {
            $follower->follow($userId);
        }
    }
}
