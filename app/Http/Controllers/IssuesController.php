<?php

namespace App\Http\Controllers;


use App\Issue;

class IssuesController extends Controller
{
    public function store()
    {

        Issue::create(
            request()->validate([
                'title' => 'required',
                'description' => 'required|min:20|max:350'
            ])
        );

        return response(['message' => 'Your issue has been submitted, we will resolve it as soon as possible']);
    }
}
