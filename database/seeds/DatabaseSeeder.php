<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class); // 填充用户
      // $this->call(UserInfosTableSeeder::class); // 填充用户
      // $this->call(LinksTableSeeder::class); // 填充边栏资源推荐
      $this->call(ArticlesTableSeeder::class); // 填充边栏资源推荐
    }
}
