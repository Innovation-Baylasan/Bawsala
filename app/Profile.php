<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'entity_id', 'cover', 'Logo', 'Address'
    ];

    public function entity ()
    {
        // Every profile related to one entity
        return $this->belongsTo(Entity::class);
    }
}
