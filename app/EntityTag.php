<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityTag extends Model
{
    protected $table = 'entity_tag';

    protected $fillable = [
        'entity_id', 'tag_id'
    ];

    public function tag ()
    {
        return $this->belongsTo(Tag::class);
    }

    public function entity ()
    {
        return $this->belongsTo(Entity::class);
    }
}
