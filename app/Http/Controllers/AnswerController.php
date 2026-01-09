<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // Show answer form
    public function create(Question $question)
    {
        return view('answers.create', compact('question'));
    }

    // Store answer
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $question->answers()->create([
            'user_id' => Auth::id(),
            'body'    => $request->body
        ]);

        return redirect()->route('index');
    }
    
}
