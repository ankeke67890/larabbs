<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户id的数组
        $user_ids = User::all()->pluck('id')->toArray();

        //所有话题（帖子)的数组id
        $topic_ids = Topic::all()->pluck('id')->toArray();

        //获取faker实列
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                          ->times(1000)
                          ->make()
                          ->each(function ($reply, $index)
                          use($user_ids, $topic_ids, $faker)
        {
            //从用户id数组中随机抽取一个并且赋值
            $reply->user_id = randomElement($user_ids);

            //从帖子id数组中随机抽取一个并且赋值
            $reply->topic_id = randomElement($topic_ids);
        });

        Reply::insert($replys->toArray());
    }

}

