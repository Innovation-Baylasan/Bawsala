<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'entity_id', 'cover', 'Logo', 'Address'
    ];
}
