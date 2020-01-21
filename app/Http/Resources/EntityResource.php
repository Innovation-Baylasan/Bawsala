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
            'avatar' => $this->avatar,
            'cover' => $this->cover,
            'tags' => $this->tags,
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? [],
        ];
    }
}
