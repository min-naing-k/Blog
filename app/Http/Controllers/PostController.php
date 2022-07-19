<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use Auth;

class PostController extends Controller
{
  public function index()
  {
    // $this->authorize('admin');
    $posts = Post::where('status', 'public')->orderBy('updated_at', 'desc')
      ->filter(request(['search', 'category', 'author']))
      ->paginate(9)
      ->withQueryString();

    return view('posts.index', [
      'posts' => $posts,
    ]);
  }

  public function show(Post $post)
  { // Blog::findOrFail($id) // Route binding (default find by id)
    return view('posts.show', [
      'post' => $post,
      'views' => $this->updatePostView($post),
      'randomPosts' => Post::where('status', 'public')
        ->where('id', '!=', $post->id)
        ->inRandomOrder()
        ->take(3)
        ->get(),
    ]);
  }

  protected function updatePostView(Post $post)
  {
    if (Auth::check()) {
      $post_view = PostView::firstOrCreate([
        'post_id' => $post->id,
        'user_id' => auth()->id(),
      ]);
    } else {
      PostView::firstOrCreate([
        'post_id' => $post->id,
        'ip' => request()->ip(),
      ]);
    }
    return PostView::where('post_id', $post->id)->count();
  }
}
