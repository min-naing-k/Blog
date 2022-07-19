<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  /**
   * * Data that you want to protect
   */
  protected $guarded = ['id'];

  /**
   * * Data that you want to allow
   */
  // protected $fillable = ['title', 'intro', 'body'];

  /**
   * * Overwrite finding by "id" to "thing you desire"
   */
  // public function getRouteKeyName()
  // {
  //   return 'slug';
  // }

  protected $with = ['category', 'author', 'views', 'bookmarks', 'comments'];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, fn($query, $search) =>
      $query->where(fn($query) =>
        $query->where('title', 'like', '%' . $search . '%')
          ->orWhere('body', 'like', '%' . $search . '%')
          ->orWhere('excerpt', 'like', '%' . $search . '%')
          ->orWhereHas('author', fn($query) =>
            $query->where('name', 'like', '%' . $search . '%')
          )
      )
    );

    $query->when($filters['category'] ?? false, fn($query, $category) =>
      $query->whereHas('category', fn($query) =>
        $query->where('slug', $category)
      )
    );

    $query->when($filters['author'] ?? false, fn($query, $author) =>
      $query->whereHas('author', fn($query) =>
        $query->where('username', $author)
      )
    );
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function views()
  {
    return $this->hasMany(PostView::class);
  }

  public function bookmarks()
  {
    return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
  }

  public function isBookmarks()
  {
    return $this->bookmarks->contains('id', auth()->id());
  }
}
