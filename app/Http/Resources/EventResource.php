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
            'event_name' => $this->event_name,
            'event_picture' => $this->event_picture,
            'registration_link' => $this->registration_link,
            'description' => $this->description,
            'application_start_datetime' => $this->application_start_datetime,
            'application_end_datetime' => $this->application_end_datetime,
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? []
        ];
    }
}
