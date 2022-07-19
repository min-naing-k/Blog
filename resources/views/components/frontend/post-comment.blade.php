@props(['comment'])
<x-frontend.panel>
  <article class="flex space-x-4">
    <div class="flex-shrink-0">
      <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="profile" width="60" height="60" class="rounded-xl">
    </div>

    <div>
      <header class="mb-4">
        <h3 class="font-bold">{{ $comment->author->name }}</h3>
        <p class="text-xs text-gray-500">
          Posted
          <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
        </p>
      </header>

      <p>
        {{ $comment->body }}
      </p>
    </div>
  </article>
</x-frontend.panel>
