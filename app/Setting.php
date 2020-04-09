<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 */
class Setting extends Model
{
    protected $guarded = [];
}
