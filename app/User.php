<?php

namespace App;

use Illuminate\Support\Str;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Traits\CanFollow;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property mixed $role
 */
class User extends Authenticatable implements JWTSubject, Follower
{
//    use HasApiTokens, Notifiable,CanFollow;
    use Notifiable,CanFollow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'username'
    ];
    /**
     * The relations to append when return this user
     *
     * @var array
     */
    protected $with = ['role'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
