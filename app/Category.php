<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => Storage::url($this->icon),
            'icon_png' => Storage::url($this->icon_png),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }


    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return "/admin/categories/$this->id";
    }
}
