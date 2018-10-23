<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 18-10-24
 * Time: 上午12:38
 */

namespace App;

use Illuminate\Support\Facades\Auth;

trait Likability
{
    public function like(){
        $like = new Like(['user_id' => Auth::id()]);
        $this->likes()->save($like);
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likable');
    }

    public function unlike(){
        return $this->likes()->where('user_id', Auth::id())->delete();
    }

    public function toggle(){
        return $this->isLiked()?$this->unlike():$this->like();
    }

    public function likesCount(){
        return $this->likes()->count();
    }

    public function isLiked() {
        return !! $this->likes()
                ->where('user_id', Auth::id())
                ->count();
    }
}