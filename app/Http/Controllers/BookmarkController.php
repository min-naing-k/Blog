<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class BookmarkController extends Controller
{
  public function index()
  {
    $currentUser = User::findOrFail(auth()->id());
    return view('settings.bookmarks.index', [
      'posts' => $currentUser->bookmarks()
        ->without('category', 'bookmarks', 'views', 'comments')
        ->orderBy('bookmarks.created_at', 'desc')
        ->paginate(5)
        ->withQueryString(),
    ]);
  }

  public function store(Post $post)
  {
    if (auth()->id()) {
      if (!$post->isBookmarks()) {
        $post->bookmarks()->attach(auth()->id());
        return back()->with('success', 'Saved to Bookmark Successfully.');
      }

      $post->bookmarks()->detach(auth()->id());
      return back()->with('success', 'Removed from Bookmark Successfully.');
    }
  }
}
