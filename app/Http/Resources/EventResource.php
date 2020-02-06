<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'entity' => $this->entity,
            'creator' => $this->user,
            'name' => $this->name,
            'picture' => $this->picture,
            'link' => $this->link,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? []
        ];
    }
}
