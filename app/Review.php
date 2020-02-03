<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'writer' => $this->writer->name,
            'entity_id' => $this->entity_id,
            'review' => $this->review,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function entity()
    {
        $this->belongsTo(Entity::class);
    }
}
