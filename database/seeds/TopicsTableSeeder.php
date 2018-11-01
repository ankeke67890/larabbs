<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //获取所有用户ID数组
        $user_ids = User::all()->pluk('id')->toArray();

        //获取所有帖子分类的Id数组
        $category_ids = Category::all()->pluk('id')->toArray();

        //获取faker实例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                        ->time(100)
                        ->make()
                        ->each(function($topic, $index)
                                use($user_ids, $category_ids, $faker)
        {
            //从id中随机取出一个并且赋值
            $topic->user_id = $faker->randomElement($user_ids);

            $topic->category_id = $faker->randomElement($category_ids);
        });

        //将数据集合转换成数组并且写入数据库
        Topic::insert($topics->toArray());
    }

}

