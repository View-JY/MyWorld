<?php

use Illuminate\Database\Seeder;
use App\Models\UserInfo;
use App\User;

class UserInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 获取 Faker 实例
      $faker = app(Faker\Generator::class);

      // 所有用户 ID 数组，如：[1,2,3,4]
      $user_ids = User::all() ->pluck('id') ->toArray();

      // 头像假数据
      $avatars = [
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
      ];

      // 生成数据集合
      $userinfos = factory(UserInfo::class) ->times(5) ->make()->each(function ($userinfos, $index) use ($faker, $avatars, $user_ids) {
        $userinfos ->avatar = $faker ->randomElement($avatars);
        $userinfos ->user_id = $faker ->randomElement($user_ids);
      });

      $userinfo_array = $userinfos ->makeVisible(['password', 'remember_token'])->toArray();

      // 插入到数据库中
      UserInfo::insert($userinfo_array);
    }
}
