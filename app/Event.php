<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Event extends Model implements HasMedia
{

    use HasMediaTrait, Searchable;

    /**
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'entity_id',
        'name',
        'picture',
        'link',
        'description',
        'start_date',
        'end_date',
        'latitude',
        'longitude'
    ];

    /**
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {

        $this->addMediaConversion('cover')
            ->fit(Manipulations::FIT_FILL, 120, 120)
            ->background('#c43b68')
            ->nonQueued()
            ->performOnCollections('covers');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
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
     * @param $cover
     * @return $this
     */
    public function setCover($cover)
    {
        $this->addMedia($cover)->toMediaCollection('covers');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoverAttribute()
    {
        $cover = $this->getMedia('covers')->first();
        return $cover ? $cover->getUrl('cover') : 'https://placeimg.com/640/460/tech';
    }
}
