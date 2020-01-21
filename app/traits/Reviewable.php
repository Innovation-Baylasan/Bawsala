<?php
/**
 * Created by PhpStorm.
 * User: owiesnama
 * Date: 08/01/20
 * Time: 06:11 م
 */

namespace App\Traits;


use App\Review;

trait Reviewable
{

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function review($body, $user = null)
    {
        return $this->reviews()->create([
            'user_id' => $user ? $user->id : auth()->id(),
            'review' => $body,
        ]);
    }
}