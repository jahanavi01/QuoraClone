<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function show(User $user)
    {
        $authUser = auth()->user();

        // Questions asked by this user
        $questions = Question::where('user_id', $user->id)
            ->latest()
            ->get();

        // Follow status
        $isFollowing = $authUser->isFollowing($user);

        return view('user', compact(
            'user',
            'questions',
            'isFollowing',
            'authUser'
        ));
    }
}
