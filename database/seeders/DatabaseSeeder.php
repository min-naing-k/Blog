<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // Before Inserting Data, Delete all Data
    // User::truncate();
    // Blog::truncate();
    // Category::truncate();

    $frontend = Category::factory()->create(['name' => 'frontend', 'slug' => 'frontend']);
    $backend = Category::factory()->create(['name' => 'backend', 'slug' => 'backend']);

    $user_one = User::factory()->create(['name' => 'aung aung', 'username' => 'aung-aung' . uniqid()]);
    $user_two = User::factory()->create(['name' => 'mg mg', 'username' => 'mg-mg' . uniqid()]);
    $user_three = User::factory()->create(['name' => 'tun tun', 'username' => 'tun-tun' . uniqid()]);
    $user_four = User::factory()->create(['name' => 'zaw zaw', 'username' => 'zaw-zaw' . uniqid()]);

    Post::factory(20)->create(['category_id' => $frontend->id, 'user_id' => $user_one->id]);
    Post::factory(19)->create(['category_id' => $frontend->id, 'user_id' => $user_four->id]);
    Post::factory(25)->create(['category_id' => $backend->id, 'user_id' => $user_two->id]);
    Post::factory(15)->create(['category_id' => $backend->id, 'user_id' => $user_three->id]);

    Comment::factory()->create(['post_id' => 1, 'user_id' => 1]);
    Comment::factory()->create(['post_id' => 1, 'user_id' => 2]);
    Comment::factory()->create(['post_id' => 1, 'user_id' => 3]);
    Comment::factory()->create(['post_id' => 1, 'user_id' => 4]);

    $user_one->followings()->attach(User::factory(10)->create()->pluck('id'));
    $user_one->followers()->attach(User::factory(10)->create()->pluck('id'));
  }
}
