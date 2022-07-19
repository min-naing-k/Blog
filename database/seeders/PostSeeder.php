<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $status = ['public', 'private'];
    foreach (range(0, 10) as $item) {
      $post = new Post();
      $post->user_id = $item + 1;
      $post->category_id = rand(1, 2);
      $post->title = Str::random(10);
      $post->status = $status[rand(0, 1)];
      $post->slug = uniqid() . '-' . time();
      $post->excerpt = Str::random(20);
      $post->body = Str::random(150);
      $post->save();
    }
  }
}
