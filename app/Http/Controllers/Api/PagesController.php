<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use App\Setting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function terms()
    {
        $terms = Setting::firstOrNew(['key' => 'terms'], ['value' => '']);

        return response(['data' => $terms]);
    }

    public function policy()
    {
        $policy = Setting::firstOrNew(['key' => 'policy'], ['value' => '']);

        return response(['data' => $policy]);
    }

    public function faq()
    {
        $questions = Question::latest()->get();

        return response(['data' => $questions]);
    }
}
