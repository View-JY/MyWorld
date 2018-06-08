<?php

namespace App\Observers;

use App\Models\UserInfo;

class UserInfoObserver
{
    public function creating(UserInfo $userinfo)
    {
        if (empty($userinfo ->avatar)) {
            $userinfo ->avatar = 'https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg';
        }
    }
}
