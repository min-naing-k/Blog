<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'username',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function setPasswordAttribute($password)
  {
    $this->attributes['password'] = bcrypt($password);
  }

  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  public function comments()
  {
    $this->hasMany(Comment::class);
  }

  public function views()
  {
    return $this->hasMany(PostView::class);
  }

  public function bookmarks()
  {
    return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')->withTimestamps();
  }

  public function followers()
  {
    return $this->belongsToMany(User::class, 'follow', 'followed_id', 'follower_id')->withTimestamps();
  }

  public function followings()
  {
    return $this->belongsToMany(User::class, 'follow', 'follower_id', 'followed_id')->withTimestamps();
  }
}
