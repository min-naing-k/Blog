@props(['heading'])

<main class="w-full max-w-5xl mx-auto" style="margin-top: 5rem">
  <h1 class="font-bold text-xl mb-5 pb-3 mb-4 border-b border-gray-200">{{ $heading }}</h1>
  <div class="flex gap-x-4">
    <aside class="w-56 flex-shrink-0">
      <ul>
        @admin
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('admin/posts') ? 'bg-blue-500 text-white' : '' }}"
            href="/admin/posts">
            All Posts
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('admin/posts/create') ? 'bg-blue-500 text-white' : '' }}"
            href="/admin/posts/create">
            New Post
          </a>
        </li>
      @else
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/posts') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/posts">
            My Posts
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/posts/create') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/posts/create">
            New Post
          </a>
        </li>
        @endadmin
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/bookmarks') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/bookmarks">
            Bookmarks
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/followers') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/followers">
            Followers
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/followings') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/followings">
            Following
          </a>
        </li>
        <li>
          <a class="block p-4 mb-4 bg-gray-100 rounded-xl {{ request()->is('settings/authors') ? 'bg-blue-500 text-white' : '' }}"
            href="/settings/authors">
            Authors
          </a>
        </li>
      </ul>
    </aside>

    <main class="flex-1">
      {{ $slot }}
    </main>
  </div>
</main>
