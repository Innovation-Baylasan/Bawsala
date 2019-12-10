<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $profile
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'avatar' => $this->profile->logo,
            'cover' => $this->profile->cover,
            'location' => $this->location,
        ];
    }
}
