<?php

namespace App\Filters;

use App\Category;
use Illuminate\Http\Request;

class EntitiesFilter
{

    protected $request;

    /**
     * EntitiesFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder) {

        if ($this->request['q']) {
            $builder->searchEntities($this->request['q'])->take(7);
        }

        if ($this->request['category']) {
            $category = Category::where('name', $this->request['category'])->first();
            $builder->where('category_id', $category ? $category->id : 0);
        }

        if (($latitude = $this->request['@lat']) && ($longitude = $this->request['@long'])) {
            $builder->nearby($latitude, $longitude,
                $this->request['radios'] ?: '100', $this->request['unit'] ?: 'km'
            );
        }

        return $builder;

    }

}
