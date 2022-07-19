@props(['posts'])

<x-frontend.post-feature-card :post="$posts[0]" />

@if ($posts->count() > 1)
  <div class="lg:grid lg:grid-cols-6 lg:gap-4">
    @foreach ($posts->skip(1) as $post)
      <x-frontend.post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" />
    @endforeach
  </div>
@endif
