<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Event extends Model implements HasMedia
{

    use HasMediaTrait;

    /**
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'title', 'description', 'due_date', 'cover'
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
