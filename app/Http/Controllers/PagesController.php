<?php

namespace App\Http\Controllers;

use App\Question;
use App\Setting;

class PagesController extends Controller
{
    public function terms()
    {
        $terms = Setting::firstOrNew(['key' => 'terms'], ['value' => '']);

        return view('terms', compact('terms'));
    }

    public function policy()
    {
        $policy = Setting::firstOrNew(['key' => 'policy'], ['value' => '']);

        return view('policy', compact('policy'));
    }

    public function faq()
    {
        $questions = Question::latest()->get();

        return view('faq', compact('questions'));
    }
}
