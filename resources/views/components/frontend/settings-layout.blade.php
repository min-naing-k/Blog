@props(['heading'])

<main class="w-full max-w-5xl mx-auto" style="margin-top: 5rem">
  <h1 class="font-bold text-xl mb-5 pb-3 mb-4 border-b border-gray-200">{{ $heading }}</h1>
  <div class="flex gap-x-4">
    <aside class="w-56 flex-shrink-0">
      <ul>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/posts') ? 'bg-blue-500 text-white' : '' }}" href="/settings/posts">
            My Posts
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/posts/create') ? 'bg-blue-500 text-white' : '' }}" href="/settings/posts/create">
            New Post
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/bookmarks') ? 'bg-blue-500 text-white' : '' }}" href="/settings/bookmarks">
            Bookmarks
          </a>
        </li>
      </ul>
    </aside>

    <main class="flex-1">
      {{ $slot }}
    </main>
  </div>
</main>
