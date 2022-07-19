<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostPublished;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
  public function index()
  {
    $posts = Post::orderBy('updated_at', 'desc')->paginate(5);
    return view('admin.posts.index', ['posts' => $posts]);
  }

  public function create()
  {
    $categories = Category::all();
    return view('admin.posts.create', compact('categories'));
  }

  public function store()
  {
    // file is stored into the (storage/app/thumbnails/__.png) if we dont change config/filestystems.php ('default' => env('FILESYSTEM_DRIVER', 'local'))
    // If not, file is stored into the (storage/app/public/thumbnails/__.png) if we dont change config/filestystems.php ('default' => env('FILESYSTEM_DRIVER', 'public'))
    $post = Post::create(array_merge($this->validatePost(), [
      'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
      'user_id' => auth()->id(),
      'slug' => Str::slug($this->validatePost()['title']) . '-' . uniqid(),
      'excerpt' => strlen($this->validatePost()['body']) >= 100 ? substr($this->validatePost()['body'], 0, 100) . '...' : $this->validatePost()['body'],
    ]));

    if ($post->status === 'public') {
      $currentUser = User::findOrFail(auth()->id());
      $currentUser->followers->each(fn($follower) => $follower->notify(new PostPublished($post, $follower->name)));
      $post->update([
        'is_send' => true,
      ]);
    }

    return redirect('/')->with('success', 'Post is created successfully');
  }

  public function edit(Post $post)
  {
    $authors = User::all();
    $categories = Category::all();
    return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'authors' => $authors]);
  }

  public function update(Post $post)
  {
    $attributes = $this->validatePost($post);
    $attributes['user_id'] = request('user_id');
    if ($attributes['thumbnail'] ?? false) {
      $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
      if ($post->thumbnail && file_exists('storage/' . $post->thumbnail)) {
        unlink('storage/' . $post->thumbnail);
      }
    }

    $post->update($attributes);

    if (!$post->is_send) {
      $currentUser = User::findOrFail(auth()->id());
      $currentUser->followers->each(fn($follower) => $follower->notify(new PostPublished($post, $follower->name)));
      $post->update([
        'is_send' => true,
      ]);
    }

    return back()->with('success', 'Post Updated Successfully!');
  }

  public function delete(Post $post)
  {
    if ($post->thumbnail && file_exists('storage/' . $post->thumbnail)) {
      unlink('storage/' . $post->thumbnail);
    }

    $post->delete();

    return back()->with('success', 'Post is Deleted Successfully!');
  }

  protected function validatePost(Post $post = null)
  {
    $post??=new Post();
    return request()->validate([
      'title' => 'required',
      'thumbnail' => $post->exists ? 'image' : 'required|image',
      'category_id' => ['required', Rule::exists('categories', 'id')],
      'body' => 'required',
      'status' => 'required',
    ], ['category_id.required' => 'The category field is required']);
  }
}
