<?php

namespace App\Http\Controllers;


use App\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::all();

        return view('faq', compact('questions'));
    }
}
