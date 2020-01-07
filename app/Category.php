<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'icon', 'icon_png'
    ];

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
