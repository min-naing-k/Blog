<x-frontend.layout>
  <x-frontend.hero />
  <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    @if ($posts->count())
      <x-frontend.posts-grid :posts="$posts" />

      {{-- {{ $posts->links('', ['type' => 'posts']) }} --}}
      {{ $posts->links('vendor.pagination.custom_pagination') }}
    @else
      <p class="text-center">No posts yet.Please check back later...</p>
    @endif
  </main>
</x-frontend.layout>
