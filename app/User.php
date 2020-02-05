<?php

namespace App;

use App\Events\CompanyRegistered;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
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

    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role'
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
     * @param $attributes
     */
    public static function register($attributes)
    {
        $user = static::create($attributes);
        if ($attributes['role'] == 'company') {
            event(new CompanyRegistered($user));
        }

        return $user;
    }

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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }


    public function mainEntity()
    {
        return $this->entities()->oldest()->first() ?: new Entity();
    }

    /**
     * @return bool
     */
    public function isCompany()
    {
        return !!($this->role == 'company');
    }

    /**
     * check whether this user is admin or not
     *
     * @return bool
     */
    public function isAdmin()
    {
        return !!($this->role == 'admin');
    }

    public function profilePath()
    {
        $destinations = [
            'company' => "/@" . $this->entities()->first() ?? $this->entities()->first()->id,
            'user' => "/account/{$this->username}",
            'admin' => "/account/{$this->username}",
        ];

        return $destinations[$this->role];
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
