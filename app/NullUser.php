<?php

namespace App;

class NullUser extends User
{
    public $email = '';

    /**
     * @return Entity
     */
    public function mainEntity()
    {
        return new Entity();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities()
    {
        return collect(new Entity());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return collect(new Event());
    }


}