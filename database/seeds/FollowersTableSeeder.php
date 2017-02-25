<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();//取出数据库中所有用户
        $user=$users->first();//获取第一个用户
        $user_id=$user->id;//把ID赋值给user_id

        $followers=$users->slice(1);//获取除了1号的所有用户
        $follower_ids=$followers->pluck('id')->toarray();//取出ID字段并合成数组

        $user->follow($follower_ids);//1号用户关注其他所有人
        foreach ($followers as $follower) {
        	$follower->follow($user_id);//其他所有人关注1号用户
        }
    }
}
