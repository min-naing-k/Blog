@props(['post'])
<header>
  <div class="space-x-2 flex justify-between item-center">
    <div>
      <x-frontend.category-button :category="$post->category" />
    </div>
    <div>
      <form action="/posts/{{ $post->slug }}/bookmark" method="POST">
        @csrf
        <div class="flex">
          <div class="w-full text-center">
            <button
              class="bg-white text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
              type="submit"
              onmouseenter="openPopover(event, {{ $post->id }})"
              onmouseleave="openPopover(event, {{ $post->id }})">
              <i class="{{ $post->isBookmarks() ? 'fas text-gray-500' : 'far text-gray-400' }} fa-bookmark pointer-events-none"></i>
            </button>
            <div
              class="hidden border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
              id="{{ $post->id }}">
              <div>
                <div class="bg-white text-gray-500 text-xs p-2 mb-1 border border-solid rounded">
                  {{ $post->isBookmarks() ? 'Already Saved' : 'Save to Bookmark' }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="mt-4">
    <h1 class="text-3xl">
      <a href="/posts/{{ $post->slug }}">
        {{ $post->title }}
      </a>
    </h1>

    <x-frontend.features :post="$post" />
  </div>
</header>
