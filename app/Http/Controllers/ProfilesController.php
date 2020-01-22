<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * @param Entity $entity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Entity $entity)
    {
        return view('profile', compact('entity'));
    }
}
