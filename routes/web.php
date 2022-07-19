<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SettingController;
use App\Models\Post;
use App\Models\Student;
use App\Models\User;
use App\Notifications\PostPublished;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// watch the query log file
// DB::listen(function ($query) {
//   Log::info('something')
//   logger($query->sql);
// });

// Home
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->where('post', '[A-z\d\-_]+');
Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store'])->middleware('auth');
Route::post('posts/{post:slug}/bookmark', [BookmarkController::class, 'store'])->middleware('auth');

// Settings
Route::resource('settings/posts', SettingController::class)->except(['show']);
Route::get('settings/posts/{post:slug}/edit', [SettingController::class, 'edit'])->middleware('auth');
Route::patch('settings/posts/{post:slug}', [SettingController::class, 'update'])->middleware('auth');
Route::delete('settings/posts/{post:slug}', [SettingController::class, 'destroy'])->middleware('auth');
Route::get('settings/bookmarks', [BookmarkController::class, 'index'])->middleware('auth');
Route::get('settings/followers', [FollowerController::class, 'index'])->middleware('auth');
Route::get('settings/followings', [FollowingController::class, 'index'])->middleware('auth');
Route::post('settings/followings/{id}', [FollowingController::class, 'store'])->middleware('auth');
Route::delete('settings/followings/{id}', [FollowingController::class, 'destroy'])->middleware('auth');
Route::get('settings/authors', [AuthorController::class, 'index'])->middleware('auth');

//Sending Email
Route::get('/email', function () {
  $post = Post::without('category', 'author', 'views', 'bookmarks', 'comments')->first();
  $user = User::first();
  $user->notify(new PostPublished($post, $user->name));
});

// Admin
Route::middleware('can:admin')->group(function () {
  Route::get('admin/posts', [AdminPostController::class, 'index']);
  Route::get('admin/posts/create', [AdminPostController::class, 'create']);
  Route::post('admin/posts', [AdminPostController::class, 'store']);
  Route::get('admin/posts/{post:slug}/edit', [AdminPostController::class, 'edit']);
  Route::patch('admin/posts/{post:slug}', [AdminPostController::class, 'update']);
  Route::delete('admin/posts/{post:slug}', [AdminPostController::class, 'delete']);
});

// Mailchimp subscription
Route::post('newsletter', NewsletterController::class);

// Authentication
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// index(database), show(database), create, store(database), edit, update(database), destroy(database)

// Route::get('categories/{category:slug}', function (Category $category) {
//   return view('posts', [
//     'posts' => $category->posts,
//     'currentCategory' => $category,
//     'categories' => Category::all(),
//   ]);
// })->name('category');

// Route::get('authors/{user:username}', function (User $user) { // User::findOrFail($id)
//   return view('posts', [
//     'posts' => $user->posts(),
//   ]);
// });

// Wildcard constraint
// ->whereAlphaNumeric('blog')
// ->whereAlpha('blog')
// ->whereNumeric('blog')

Route::get('clone', function () {
  $query = Post::query();

  $today = request('date') ?? date('Y-m-d');

  if ($today) {
    $query->whereDate('created_at', $today);
  }

  $private_posts = (clone $query)->where('status', 'private')->get();
  $public_posts = (clone $query)->where('status', 'public')->get();

  return [
    'public_posts' => $public_posts,
    'private_posts' => $private_posts,
  ];
});

Route::get('students', function () {
  // =========== SoftDeletes =============//
  // Student::findOrFail(4)->delete();
  // return Student::withTrashed()->where('id', 1)->get();
  // return Student::onlyTrashed()->get();
  // Student::onlyTrashed()->where('id', 1)->restore();
  // Student::withTrashed()->where('id', 2)->restore();
  // $students = Student::withTrashed(['id', 'name'])->get();
  // return $students->filter(fn($student) => $student->trashed());
  // Will not exclude soft deletes
  // return DB::table('students')->get();

  // =========== GroupBy =============//
  Student::find(1)->delete();
  $students = Student::all()->groupBy(fn($student) => $student->age);
  return view('group_by', compact('students'));
});
