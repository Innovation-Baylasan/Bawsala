<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
