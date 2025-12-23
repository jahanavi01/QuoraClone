<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request,$question_id){
        $request->validate([
            "body"=>"required|string"
        ]);
        $answer=Answer::create([
            "user_id"=>Auth::id(),
            "question_id"=>$question_id,
            "body"=>$request->body,
        ]);
        return response()->json($answer);
    }
    public function destroy($id){
        
    }
}

