<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property mixed $profile
 * @property mixed $cover
 */
class Entity extends Model
{
    /**
     * Make the model searchable using Laravel Scout
     *
     * @Laravel\Scout\Searchable
     * */
    use Searchable;

    public $asYouType = true;

    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $with = ['category'];

    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $appends = ['cover', 'avatar'];


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


    public function getAvatarAttribute()
    {
        return $this->profile->Logo ?? '';
    }

    public function getCoverAttribute()
    {
        return $this->profile->cover ?? '';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'avatar' => $this->avatar,
            'cover' => $this->cover,
            'location' => json_encode($this->location),
        ];
    }
}
