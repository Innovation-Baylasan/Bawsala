<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'latitude',
        'longitude',
    ];
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
            'location' => json_encode($this->location),
        ];
    }

    /**
     * Query builder scope to list neighboring locations
     * within a given distance from a given location
     *
     * @param  Illuminate\Database\Query\Builder $query Query builder instance
     * @param  mixed $lat Lattitude of given location
     * @param  mixed $lng Longitude of given location
     * @param  integer $radius Optional distance
     * @param  string $unit Optional unit
     *
     * @return Illuminate\Database\Query\Builder          Modified query builder
     */
    public function scopeNearby($query, $lat, $lng, $radius = 100, $unit = "km")
    {
        $unit = ($unit === "km") ? 6378.10 : 3963.17;
        $lat = (float)$lat;
        $lng = (float)$lng;
        $radius = (double)$radius;
        return $query->having('distance', '<=', $radius)
            ->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(latitude))
                                * COS(RADIANS($lng) - RADIANS(longitude))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(latitude)))) AS distance")
            )->orderBy('distance', 'asc');
    }
}
