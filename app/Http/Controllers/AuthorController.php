<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
  public function index()
  {
    $currentUser = User::findOrFail(auth()->id());
    $followingsId = $currentUser->followings()->pluck('followed_id');
    $followingsId[] = $currentUser->id;
    $authors = User::whereNotIn('id', $followingsId)
      ->paginate(4);
    return view('settings.authors.index', ['authors' => $authors]);
  }
}
