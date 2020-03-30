<?php

namespace App;

use App\Traits\CanBeRated;
use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Mockery\Exception;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Traits\CanBeFollowed;

/**
 * @property int $id
 * @property mixed $owner
 * @property mixed $profile
 * @property mixed $category
 * @property mixed $tags
 * @property mixed $avatar
 * @property mixed $cover
 * @property mixed $reviews
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $followers_count
 */
class Entity extends Model implements Followable
{
    use Reviewable, CanBeFollowed, CanBeRated, Searchable;
    /**
     * @var bool
     */
    public $asYouType = true;

    /**
     * Determine guarded fields
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Determine what attributes  append when retrieving activity
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

        static::addGlobalScope('verified', function ($builder) {
            $builder->whereVerified(true);
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
     *
     */
    public function isFollowedBy($user)
    {
        if (!$user) return false;
        return !$this->followers(User::class)->where('follower_id', '=', $user->id)->get()->isEmpty();
    }

    /**
     * @return mixed
     *
     */
    public function getReviewsAttribute()
    {
        return $this->reviews()->take(4)->get();
    }


    /**
     * @return mixed
     *
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }


    /**
     * @return mixed
     *
     */
    public function getAverageRatingAttribute()
    {
        return $this->rating();
    }


    /**
     * @return mixed
     */
    public function getCoverAttribute()
    {
        return $this->profile->cover;
    }


    /**
     * Query builder scope to list neighboring locations
     * within a given distance from a given location
     *
     *
     * @param $query
     * @param $lat
     * @param $lng
     * @param float $radius
     * @param string $unit
     * @return mixed
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

    /**
     * Query builder scope to filter the entities according to
     * given key,value pairs form request query params
     *
     * @param $query
     * @param $filters
     * @return
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @param $query
     * @param $entity
     * @return mixed
     */
    public function scopeRelatedPlaces($query, $entity)
    {
        return $query->whereHas('tags', function ($q) use ($entity) {
            return $q->whereIn('tag_id', $entity->tags->pluck('id'));
        })->where('id', '!=', $entity->id);
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
        ];
    }

}
