<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Request;

class FollowController extends Controller
{
        // FOLLOWING FEED PAGE
    public function follow()
{
    $authUser = auth()->user();

    // IDs of users I follow
    $followingIds = $authUser->follows()
        ->where('followable_type', User::class)
        ->pluck('followable_id');

    // Users I follow (for sidebar)
    $followingUsers = User::whereIn('id', $followingIds)->get();

    // Questions asked by followed users
    $questions = Question::whereIn('user_id', $followingIds)
        ->latest()
        ->get();

    // Discover people = users I do NOT follow (exclude self)
    $discoverUsers = User::whereNotIn('id', $followingIds)
        ->where('id', '!=', $authUser->id)
        ->get();

    return view('follows.follow', compact(
        'questions',
        'discoverUsers',
        'followingUsers',
        'authUser'
    ));
}

    public function toggle(Request $request, $type, $id)
    {
        $authUser = auth()->user();
        $target = User::findOrFail($id);

        $follow = $authUser->follows()
            ->where('followable_id', $target->id)
            ->where('followable_type', User::class)
            ->first();

        if ($follow) {
            $follow->delete();
        } else {
            $target->followers()->create([
                'user_id' => $authUser->id,
            ]);
        }

        if ($request->filled('anchor')) {
            return redirect()->back()->withFragment($request->anchor);
        }

        return redirect()->back();
    }
}
