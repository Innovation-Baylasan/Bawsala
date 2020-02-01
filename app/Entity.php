<?php

namespace App;

use App\Traits\CanBeRated;
use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Traits\CanBeFollowed;

class Entity extends Model implements Followable
{
    use Reviewable, CanBeFollowed, CanBeRated, Searchable;

    public $asYouType = true;

    /**
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'latitude', 'longitude', 'details'];
    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $with = ['category', 'tags', 'reviews'];

    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $appends = ['cover', 'avatar', 'followers_count'];
    protected $hidden = ['profile', 'profile_id', 'followers'];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($modal) {
            Profile::create(['entity_id' => $modal->id]);
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    /**
     *
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function siblings()
    {
        return $this->where('parent_id', $this->parent_id)->where('parent_id', '!=', null)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subEntities()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     *
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * associate entity with a tag
     *
     */
    public function tag($tag)
    {
        $tag = Tag::firstOrCreate(['name' => $tag]);
        return $this->tags()->attach($tag);
    }

    /**
     * associate entity with many tags
     *
     */
    public function tagMany($tags)
    {
        foreach ($tags as $tag) {
            $this->tag($tag);
        }
        return true;
    }

    /**
     * @return mixed
     *
     */
    public function getAvatarAttribute()
    {
        return $this->profile->avatar;
    }

    /**
     * @return mixed
     *
     */
    public function getFollowersCountAttribute()
    {
        return $this->followers(User::class)->count();
    }

    /**
     * @return mixed
     */
    public function getCoverAttribute()
    {
        return $this->profile->cover;
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
     *
     */
    public function scopeNearby($query, $lat, $lng, $radius = 1.5, $unit = "km")
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

    public function scopeSearchEntities($searchTerm) {
        return Entity::search($searchTerm);
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }
}
