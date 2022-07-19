<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostPublished extends Notification
{
  use Queueable;

  protected $post;
  protected $followerName;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(Post $post, $followerName)
  {
    $this->post = $post;
    $this->followerName = $followerName;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->success()
      ->greeting('Hello ' . ucwords($this->followerName) . '!')
      ->subject('New Post:' . $this->post->title)
      ->line('The new post was published by ' . $this->post->author->name . '.')
      ->action('Watch it now!', url('/posts/' . $this->post->slug))
      ->line('Thank you for using our blog application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
