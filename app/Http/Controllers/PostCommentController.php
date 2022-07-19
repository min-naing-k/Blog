<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostCommentController extends Controller
{
  public function store(Post $post)
  {
    $attributes = request()->validate([
      'body' => 'required',
    ], ['body.required' => 'Please type something!']);

    $post->comments()->create([
      'user_id' => auth()->id(),
      'body' => $attributes['body'],
    ]);

    return back();
  }
}
