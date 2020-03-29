<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $entities
 * @property string $path
 */
class Category extends Model
{
    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return "/admin/categories/$this->id";
    }

}
