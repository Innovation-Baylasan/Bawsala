<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EntityVerificationController extends Controller
{
    /**
     * @param Entity $entity
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $id
     *
     * @internal param Entity $entity
     */
    public function store(Entity $entity)
    {
        $entity->update(['verified' => true, 'verified_at' => Carbon::now()]);

        return back();
    }

    /**
     *
     * @param Entity $entity
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $id
     *
     * @internal param Entity $entity
     */
    public function destroy(Entity $entity)
    {
        $entity->update(['verified' => false]);

        return back();
    }
}
