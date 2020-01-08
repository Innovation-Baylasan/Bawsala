<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function entity()
    {
        $this->belongsTo(Entity::class);
    }
}
