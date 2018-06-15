<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Article;
use App\Models\Category;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 所有用户 ID 数组，如：[1,2,3,4]
      $user_ids = User::all()->pluck('id')->toArray();

      // 所有分类 ID 数组，如：[1,2,3,4]
      $category_ids = Category::all()->pluck('id')->toArray();

      // 头像假数据
      $avatars = [
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
          'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
      ];

      // 获取 Faker 实例
      $faker = app(Faker\Generator::class);

      $topics = factory(Article::class)
                      ->times(100)
                      ->make()
                      ->each(function ($topic, $index)
                          use ($user_ids, $category_ids,  $avatars, $faker)
      {
          // 从用户 ID 数组中随机取出一个并赋值
          $topic->user_id = $faker->randomElement($user_ids);

          $topic->cover = $faker->randomElement($avatars);

          // 话题分类，同上
          $topic->category_id = $faker->randomElement($category_ids);
      });

      // 将数据集合转换为数组，并插入到数据库中
      Article::insert($topics->toArray());
    }
}
