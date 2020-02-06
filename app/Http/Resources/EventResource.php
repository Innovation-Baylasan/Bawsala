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
            'registration_link' => $this->registration_link,
            'description' => $this->description,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? []
        ];
    }
}
