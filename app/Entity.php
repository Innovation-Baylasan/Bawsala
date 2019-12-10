<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $with = ['category'];
    /**
     * Determine what to cast when retrieving data
     *
     * @var array
     */
    protected $casts = [
        'location' => 'array'
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'location'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function profile ()
    {
        // Every entity has one profile
        return $this->hasOne(Profile::class);

    }

}
