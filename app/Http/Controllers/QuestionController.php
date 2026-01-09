<?php

namespace App\Http\Controllers;

use App\Models\Question;
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

        return back();
    }

    
    public function follow($id)
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

        return back();
    }
}
