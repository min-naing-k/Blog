<x-frontend.dropdown>
  <x-slot name="trigger">
    <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 flex lg:inline-flex">
      {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

      <x-frontend.icon name="down-icon" class="absolute pointer-events-none" style="right: 12px" />
    </button>
  </x-slot>

  <x-frontend.dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="request()->routeIs('home') && request('category') === null">
    All
  </x-frontend.dropdown-item>
  @foreach ($categories as $category)
    <x-frontend.dropdown-item href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
      :active="isset($currentCategory) && $currentCategory->is($category)">
      {{ ucwords($category->name) }}
    </x-frontend.dropdown-item>
  @endforeach
</x-frontend.dropdown>
