<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @property mixed $entity
 */
class Profile extends Model
{
    use HasMediaTrait;
    /**
     * Determine fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'cover', 'Logo', 'Address'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
