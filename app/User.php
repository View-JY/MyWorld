<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\RestPassword as RestPasswordNotification; // 替换
use App\Models\Article;
use App\Models\ArticleZan;
use App\Models\CommentZan;
use App\Models\Comment;
use App\Models\UserInfo;
use App\Models\CategoryKeep;
use App\Models\Category;
use App\Models\Works;
use Auth;

class User extends Authenticatable
{
    use \App\Models\Traits\ActiveUserHelper;

    // 回复通知
    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'college', 'class', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RestPasswordNotification($token));
    }

    // 与文章建立关联(一对多)
    public function article()
    {
      return $this ->hasMany(Article::class);
    }

    // 与文章赞建立关联（一对多）
    public function articleZan()
    {
      return $this ->hasMany(ArticleZan::class);
    }

    // 与回复建立关联(一对多)
    public function comment()
    {
      return $this ->hasMany(Comment::class);
    }

    // 清除回复通知归零
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

  	// 被关注用户查看谁关注了我（与关注建立多对多关联）
  	public function followers() {
  		return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
  	}

  	// 我关注了哪些用户（与关注建立多对多关联）
  	public function followings() {
  		return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
  	}

    // 关注作者
  	public function follow($user_id) {
  		if (!is_array($user_id)) {
  			$user_ids = compact('user_id');
  		}
  		$this->followings()->sync($user_id, false);
  	}

    // 取消关注作者
  	public function unfollow($user_id) {
  		if (!is_array($user_id)) {
  			$user_ids = compact('user_id');
  		}
  		$this->followings()->detach($user_id);
  	}

    // 是否关注了作者
  	public function isFollowing($user_id) {
  		return $this->followings->contains($user_id);
  	}

    // 与用户信息建立关联
    public function userinfo()
    {
      return $this ->hasOne(UserInfo::class);
    }

    // 与关注分类建立关系
    public function categoryKeep()
    {
      return $this ->hasMany(CategoryKeep::class);
    }

    // 与分类建立关系
    public function category()
    {
      return $this ->hasMany(Category::class);
    }

    // 与文集一对多关系
    public function work()
    {
      return $this ->hasMany(Work::class);
    }

    // 与评论赞建立关联（一对多）
    public function commentZan()
    {
      return $this ->hasMany(CommentZan::class);
    }
}
