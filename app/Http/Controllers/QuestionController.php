<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        Question::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'details' => $request->details,
        ]);

        return redirect()->route('questions.index');
    }

   public function answer($id)
{
    $question = Question::with('answers.user')->findOrFail($id);

    return view('questions.answers', compact('question'));
}


    
    public function vote(Request $request, $id)
{
    $request->validate([
        'direction' => 'required|in:1,-1'
    ]);

    $question = Question::findOrFail($id);

    $question->votes()->updateOrCreate(
        ['user_id' => Auth::id()],
        ['direction' => $request->direction]
    );

    if ($request->filled('anchor')) {
        return redirect()->back()->withFragment($request->anchor);
    }

    return back();
}


    
    public function follow(Request $request, $id)
{
    $question = Question::findOrFail($id);

    $existing = $question->followers()
        ->where('user_id', Auth::id())
        ->first();

    if ($existing) {
        $existing->delete();
    } else {
        $question->followers()->create([
            'user_id' => Auth::id()
        ]);
    }

    if ($request->filled('anchor')) {
        return redirect()->back()->withFragment($request->anchor);
    }

    return back();
}

}
