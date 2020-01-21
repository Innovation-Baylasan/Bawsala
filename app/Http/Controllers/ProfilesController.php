<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(Entity $entity)
    {
        return view('profile', compact('entity'));
    }
}
