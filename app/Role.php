<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role'
    ];

    public function users ()
    {
        // create user role relation ship ( 1 role can be for many users )
        // so i can say $role->users
        return $this->hasMany(User::class);

    }
}
