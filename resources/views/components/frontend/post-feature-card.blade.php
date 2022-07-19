@props(['post'])
<article class="bg-white transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
  <div class="py-6 px-5 lg:flex">
    <div class="flex-1 lg:mr-8" style="height: 350px">
      <img
        src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images/illustration-4.png' }}"
        alt="Blog Post illustration"
        class="rounded-xl" style="width: 100%;height: 100%;object-fit: cover;object-position: center" />
    </div>

    <div class="flex-1 flex flex-col justify-between">
      <x-frontend.card-header :post="$post" />

      <div class="text-sm mt-4 space-y-4 flex-1">
        {!! ucwords($post->excerpt) !!}
      </div>

      <footer class="flex justify-between items-center mt-8">
        <div class="flex items-center text-sm">
          <img
            src="/images/lary-avatar.svg"
            alt="Lary avatar" />
          <div class="ml-3">
            <h5 class="font-bold">
              <a href="/?author={{ $post->author->username }}&{{ http_build_query(request()->except('page')) }}">
                {{ $post->author->name }}
              </a>
            </h5>
          </div>
        </div>

        <div class="hidden lg:block">
          <a
            href="/posts/{{ $post->slug }}"
            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
            Read More
          </a>
        </div>
      </footer>
    </div>
  </div>
</article>
