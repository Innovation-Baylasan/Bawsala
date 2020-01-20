<?php

namespace App;

use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Traits\CanFollow;

/**
 * @property mixed $role
 */
class User extends Authenticatable implements Follower
{
    use HasApiTokens, Notifiable, CanFollow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $name
     * @return string
     */
    public static function generateUsername($name)
    {
        $username = Str::slug($name);
        $userRows = static::whereRaw("username REGEXP '^{$username}(-[0-9]*)?$'")->get();
        $countUser = count($userRows) + 1;
        return ($countUser > 1) ? "{$username}-{$countUser}" : $username;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    /**
     * check whether this user is admin or not
     *
     * @return bool
     */
    public function isAdmin()
    {
        return !!$this->role == 'admin';
    }

    /**
     * Generate Api Token For User When Login For The First Time
     *
     * @return String
     */
    public function getTokenAttribute()
    {
        if (!$this->api_token) {
            $this->api_token = Str::random(60);
            $this->save();
            return $this->api_token;
        }
        return $this->api_token;
    }
}
