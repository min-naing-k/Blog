<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class BlogWithFile
{
  public $title, $slug, $intro, $body, $date;
  public function __construct($title, $slug, $intro, $body, $date)
  {
    $this->title = $title;
    $this->slug = $slug;
    $this->intro = $intro;
    $this->body = $body;
    $this->date = $date;
  }

  public static function all()
  {
    //----- Method 4 -------//
    return cache()->rememberForever('posts.all', function () {
      return collect(File::files(resource_path('blogs')))
        ->map(function ($file) {
          $obj = YamlFrontMatter::parseFile($file); // php file matter parse (to change file to obj type)
          return new BlogWithFile($obj->title, $obj->slug, $obj->intro, $obj->body(), $obj->date);
        })
        ->sortByDesc('date');
    });
    //----- Method 3 -------//
    // $files = File::files(resource_path('blogs'));
    // return array_map(function ($file) {
    //   $obj = YamlFrontMatter::parseFile($file);
    //   return new Blog($obj->title, $obj->slug, $obj->intro, $obj->body());
    // }, $files);
    //----- Method 2 -------//
    // $blogs = [];
    // foreach ($files as $file) {
    //   $obj = YamlFrontMatter::parseFile($file);
    //   $blog = new Blog($obj->title, $obj->slug, $obj->intro, $obj->body());
    //   $blogs[] = $blog;
    // }
    // return $blogs;
    //----- Method 1 -------//
    // return array_map(function ($file) {
    //   return $file->getContents();
    // }, $files);
  }

  public static function find($slug)
  {
    $blogs = static::all();
    return $blogs->firstWhere('slug', $slug);
    //---- Method 1 ----//
    // $path = resource_path("blogs/$slug.html");
    // if (!file_exists($path)) {
    //   return redirect('/');
    // }
    // return cache()->remember("posts.$slug", now()->addMinutes(2), function () use ($path) {
    //   return file_get_contents($path);
    // });
    // 30days => now()->addDays(30)
  }

  public static function findOrFail($slug)
  {
    $blog = static::find($slug);
    !$blog && throw new ModelNotFoundException(); // send to 404 page => abort(404)
    return $blog;
  }

  public static function test()
  {
    $people = [
      [
        'name' => 'aung aung',
        'age' => 30,
      ],
      [
        'name' => 'mg mg',
        'age' => 23,
      ],
      [
        'name' => 'kyaw kyaw',
        'age' => 21,
      ],
    ];
    $peopleCollection = collect($people);
    $modifyPeopleCollection = $peopleCollection->filter(function ($person) {
      return $person['age'] > 23;
    });
    dd($peopleCollection->firstWhere('name', 'kyaw kyaw'));
    // dd($peopleCollection->first());
    // dd($modifyPeopleCollection[0]['name']);
  }
}
