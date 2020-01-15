<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = new Tag();

        if (request('q')) {
            $tags = $tags->search(request('q'));
        }

        return response([
            'data' => $tags->take(5)->get()
        ], 200);
    }
}
