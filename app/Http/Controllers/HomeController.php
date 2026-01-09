<?php

namespace App\Http\Controllers;

use App\Models\Question;


class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::with(['user', 'answers.user'])->latest()->get();


        return view('index', compact('questions'));
    }
}
