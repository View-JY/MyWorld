<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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

      // 生成数据集合
      $users = factory(User::class) ->times(5) ->make();

      $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

      // 插入到数据库中
      User::insert($user_array);
    }
}
