<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed name
 * @property mixed longitude
 */
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
            'average_rating' => $this->rating(),
            'reviews' => $this->reviews,
            'reviews_count' => $this->reviews->count(),
            'my_rating' => $this->ratingFor(auth()->user()),
            'following' => $this->isFollowedBy(auth()->user()),
            'location' => [
                    'lat' => $this->latitude,
                    'long' => $this->longitude,
                ] ?? [],
        ];
    }
}
