<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowingController extends Controller
{
  public function index()
  {
    $currentUser = User::findOrFail(auth()->id());
    $followings = $currentUser->followings()->orderBy('follow.created_at', 'desc')->paginate(5);
    return view('settings.follow.followings', ['followings' => $followings]);
  }

  public function store($id)
  {
    $currentUser = User::findOrFail(auth()->id());
    $currentUser->followings()->attach($id);
    return back()->with('success', 'Follow Successfully');
  }

  public function destroy($id)
  {
    $currentUser = User::findOrFail(auth()->id());
    $currentUser->followings()->detach($id);
    return back()->with('success', 'Unfollow Successfully');
  }
}
