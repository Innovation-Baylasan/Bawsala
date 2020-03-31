<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        return response(Question::all(), 200);
    }
}
