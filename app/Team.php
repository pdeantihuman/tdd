<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Team extends Model
{
    //
    protected $fillable = ['name', 'size'];

    public function members(){
        return $this->hasMany('App\User');
    }

    /**
     * @param User|Collection $user
     * @throws Exception
     */
    public function add($user){
        $this->guardAgainstTooManyMembers();
        $this->members()->save($user);
    }

    /**
     * @throws Exception
     */
    protected function guardAgainstTooManyMembers(){
        if ($this->count() >= $this->size){
            throw new Exception('team size reaches the limit');
        }
    }

    public function count() {
        return $this->members()->count();
    }
}
