<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * @property mixed $entity
 */
class Profile extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'Address'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('avatar')
            ->crop(Manipulations::CROP_CENTER, 120, 120)
            ->background('#c43b68')
            ->nonQueued()
            ->performOnCollections('avatars');

        $this->addMediaConversion('cover')
            ->crop(Manipulations::CROP_CENTER, 840, 360)
            ->background('#c43b68')
            ->nonQueued()
            ->performOnCollections('covers');
    }

    /**
     * @param $cover
     * @return $this
     */
    public function setCover($cover)
    {
        $this->addMediaFromUrl($cover)->toMediaCollection('covers');
        return $this;
    }

    /**
     * @param $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->addMediaFromUrl($avatar)->toMediaCollection('avatars');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoverAttribute()
    {
        $cover = $this->getMedia('covers')->last();
        return $cover ? $cover->getUrl('cover') : 'https://placeimg.com/640/360/tech';
    }

    /**
     * @return mixed
     */
    public function getAvatarAttribute()
    {
        $avatar = $this->getMedia('avatars')->last();
        return $avatar ? $avatar->getUrl('avatar') : 'https://www.gravatar.com/avatar/?s=200';
    }
}
