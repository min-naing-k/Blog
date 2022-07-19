<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
  public function index()
  {
    $currentUser = User::findOrFail(auth()->id());
    $followers = $currentUser->followers()
      ->withCount([
        'followers as isFollow' => fn($query) =>
        $query->where('follower_id', $currentUser->id),
      ])
      ->withCasts(['isFollow' => 'boolean'])
      ->orderBy('follow.created_at', 'desc')
      ->paginate(5);
    return view('settings.follow.followers', ['followers' => $followers]);
  }
}
