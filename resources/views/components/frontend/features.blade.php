@props(['post'])
<span class="mt-2 block text-gray-400 text-xs">
  Published <time class="mr-3">{{ $post->created_at->diffForHumans() }}</time>
  <span class="inline-block mr-3">
    <i class="fas fa-eye mr-1"></i>{{ $post->views->count() > 1 ? $post->views->count() . ' Views' : $post->views->count() . ' View' }}
  </span>
  <span>
    <i class="far fa-comment"></i> {{ $post->comments->count() > 1 ? $post->comments->count() . ' Comments' : $post->comments->count() . ' Comment' }}
  </span>
</span>
