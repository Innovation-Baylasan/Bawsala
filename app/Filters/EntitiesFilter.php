<?php

namespace App\Filters;

use App\Category;

class EntitiesFilter extends Filters
{


    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['category', '@lat', '@long'];

    /**
     * Filters to apply always
     *
     * @var array
     */
    protected $always = ['location'];

    /**
     * @param $categories
     * @return $this
     */
    public function category($categories)
    {
        $categories = explode(',', $categories);

        $categoriesIds = Category::whereIn('name', $categories)->pluck('id');

        return $this->builder->whereIn('category_id', $categoriesIds);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function location()
    {
        if (($latitude = $this->request['@lat']) && ($longitude = $this->request['@long'])) {
            return $this->builder->nearby($latitude, $longitude,
                $this->request['radios'] ?: '100', $this->request['unit'] ?: 'km'
            );
        }
        return $this->builder;
    }

}
