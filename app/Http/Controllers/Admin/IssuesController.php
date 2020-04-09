<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Issue;

class IssuesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $issues = Issue::latest()->paginate(10);

        return view('admin.issues.index', compact('issues'));
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Issue $issue)
    {
        $issue->update(['status' => 'reviewed']);
        return view('admin.issues.show', compact('issue'));
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Issue $issue)
    {
        $issue->toggleStatus();

        return back();
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();

        return back();
    }
}
