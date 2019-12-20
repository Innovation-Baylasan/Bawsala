<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property mixed $profile
 */
class Entity extends Model
{
    /**
     * Make the model searchable using Laravel Scout
     *
     * @Laravel\Scout\Searchable
     * */
    use Searchable;

    /**
     * The Entity primarykey
     *
     * @var string
     */

    protected $primaryKey = 'id';

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
//            'avatar' => $this->profile->logo,
//            'cover' => $this->profile->cover,
//            'location' => $this->location,
        ];
    }



    /**
     * Get the index name for the Entity model to make searchable.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'entities_index';
    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // $array = $this->toArray();

        // Customize array...

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
//            'avatar' => $this->profile->logo,
//            'cover' => $this->profile->cover,
//            'location' => $this->location,
        ];
    }

    /**
     * Get the value used to index the model.
     *
     * By default, Scout will use the
     * primary key of the model as the unique ID stored in the search index.
     * If you need to customize this behavior by using the entity name as a
     * search index
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }

    /**
     * Get the key name used to index the model.
     *
     *
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'id';
    }

}
