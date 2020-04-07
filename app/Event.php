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
     * Determine guarded fields
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Determine what to eager load when retrieving activity
     *
     * @var array
     */
    protected $appends = ['cover'];


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
        $search = [
            'name' => $this->name,
            'description' => $this->description,
        ];

        $search[$this->getKeyName()] = $this->getKey();

        return $search;
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
        return $cover ? $cover->getUrl('cover') : 'https://media.sproutsocial.com/uploads/2018/04/Facebook-Cover-Photo-Size.png';
    }

    public function deleteMyEvent()
    {

        echo("Delete my event: ");
        echo($this->user->id);

    }
}
