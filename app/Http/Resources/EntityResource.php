<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'avatar' => $this->profile->logo ?? '',
            'cover' => $this->profile->cover??'',
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? [],
        ];
    }
}
