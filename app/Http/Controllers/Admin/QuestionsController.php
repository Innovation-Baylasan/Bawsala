<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(10);

        return view('admin.faq.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.faq.create', ['question' => new Question()]);
    }

    public function edit(Question $question)
    {
        return view('admin.faq.edit', compact('question'));
    }

    public function store()
    {
        Question::create(
            $this->validateRequest()
        );

        session()->flash('message', 'The question has been saved');

        return redirect(route('questions.index'));

    }

    public function update(Question $question)
    {
        $question->update($this->validateRequest());

        session()->flash('message', 'The question has been updated');

        return redirect(route('questions.index'));
    }

    public function destroy(Question $question)
    {
        $question->delete();

        session()->flash('message', 'The question has been deleted');

        return redirect(route('questions.index'));
    }

    /**
     * @return array
     */
    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required|max:288',
            'answer' => 'required',
        ]);
    }
}
