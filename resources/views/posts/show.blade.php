<x-frontend.layout>
  <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
      <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
        <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images/illustration-1.png' }}" alt="" class="rounded-xl" />

        <p class="mt-4 block text-gray-400 text-xs">
          Published
          <time class="mr-3">{{ $post->created_at->diffForHumans() }}</time>
          <span class="block mt-2 mb-2">
            <i class="fas fa-eye mr-1"></i>{{ $views > 1 ? $views . ' Views' : $views . ' View' }}
          </span>
          <span>
            <i class="far fa-comment"></i> {{ $post->comments->count() > 1 ? $post->comments->count() . ' Comments' : $post->comments->count() . ' Comment' }}
          </span>
        </p>

        <div class="flex items-center lg:justify-center text-sm mt-4">
          <img src="/images/lary-avatar.svg" alt="Lary avatar">
          <div class="ml-3 text-left">
            <h5 class="font-bold">
              <a href="/?author={{ $post->author->username }}">
                {{ $post->author->name }}
              </a>
            </h5>
          </div>
        </div>
      </div>

      <div class="col-span-8">
        <div class="hidden lg:flex justify-between mb-6">
          <a href="/" class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
            <x-frontend.icon name="left-icon" />
            Back to Posts
          </a>

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
                      <i class="{{ $post->isBookmarks() ? 'fas' : 'far' }} fa-bookmark text-gray-500"></i>
                    </button>
                    <div
                      class="hidden border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                      id="{{ $post->id }}">
                      <div>
                        <div class="bg-white text-gray-500 text-xs p-2 mb-1 border border-solid rounded">
                          {{ $post->isBookmarks() ? 'Saved to Bookmark' : 'Save to Bookmark' }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <h1 class="font-bold text-3xl lg:text-4xl mb-10">
          {{ $post->title }}
        </h1>

        <div class="space-y-4 lg:text-lg leading-loose">
          {!! $post->body !!}
        </div>
      </div>

      <section class="col-span-8 col-start-5 mt-10 space-y-6">
        @auth
          <x-frontend.panel>
            <form method="POST" action="/posts/{{ $post->slug }}/comments">
              @csrf
              <header class="flex items-center">
                <img src="https://i.pravatar.cc/40/u={{ auth()->id() }}" alt="profile" class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
              </header>
              <div class="mt-6">
                <textarea name="body" rows="5" class="@error('body') border border-red-500 @enderror w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl p-3"
                  placeholder="Quick, think of something to say!"></textarea>
                @error('body')
                  <p class="text-red-500 text-xs">
                    {{ $message }}
                  </p>
                @enderror
              </div>
              <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">
                  Post
                </button>
              </div>
            </form>
          </x-frontend.panel>
        @else
          <p class="text-xs font-bold">
            Please <a href="/register" class="text-blue-500 hover:underline">Register</a> or <a href="/login" class="text-blue-500 hover:underline">Login</a> to leave a comment!
          </p>
        @endauth

        @foreach ($post->comments as $comment)
          {{-- N + 1 (Solved) --}}
          <x-frontend.post-comment :comment="$comment" />
        @endforeach
      </section>
    </article>

    {{-- You May Like Section --}}
    <h1 class="text-center" style="font-size: 1.5rem;margin-bottom: -1rem;margin-top: 3rem">Posts You May Like</h1>
    <div class="lg:grid lg:grid-cols-9">
      @foreach ($randomPosts as $randomPost)
        <div class="col-span-3">
          {{-- N + 1 (Solved) --}}
          <x-frontend.post-card :post="$randomPost" />
        </div>
      @endforeach
    </div>
  </main>
</x-frontend.layout>
