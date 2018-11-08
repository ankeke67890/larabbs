<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取faker实例
        $faker = app(Faker\Generator::class);
        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        //生成数据集合
        $users = factory(User::class)
                        ->time(10)
                        ->make()
                        ->each(function($user, $index)
                            use($faker, $avatars)
                        {
                            //从头像数组中随机取出一个并赋值
                            $user->avatars = $faker->randomElement($avatars);

                        });

        //让隐藏数据可见，并将数据集合转换成数组
        $user_array =$users->makeVisible(['password', 'remember_token'])->toArray();

        //写入数据库
        User::insert($user_array);

        //单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@yousails.com';
        $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->assignRole('Founder');
        //查找二号用户赋予管理员角色
        $user = User::find(2);
        $suer->assignRole('Maintainer');
        $user->save();

    }
}
