<nav class="md:flex md:justify-between md:items-center">
  <div>
    <a href="/" class="text-2xl font-semibold">
      Blog
    </a>
  </div>

  <div class="mt-8 md:mt-0 flex items-center">
    @auth
      <x-frontend.dropdown width="157px">
        <x-slot name="trigger">
          <button type="button" class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 flex lg:inline-flex" style="white-space: nowrap">
            {{ auth()->user()->name }}
            <x-frontend.icon name="down-icon" class="absolute pointer-events-none" style="right: 12px" />
          </button>
        </x-slot>
        @admin
        <x-frontend.dropdown-item href="/admin/posts">
          All Posts
        </x-frontend.dropdown-item>
        <x-frontend.dropdown-item href="/admin/posts/create">
          New Post
        </x-frontend.dropdown-item>
        @endadmin
        @if (auth()->user()->username !== 'minnaingkyaw')
          <x-frontend.dropdown-item href="/settings/posts">
            Settings
          </x-frontend.dropdown-item>
        @endif
        <x-frontend.dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">
          Logout
        </x-frontend.dropdown-item>
        <form id="logout-form" method="POST" action="/logout" class="hidden">
          @csrf
        </form>
      </x-frontend.dropdown>
    @else
      <a href="/register" class="text-xs font-bold uppercase">Register</a>
      <a href="/login" class="text-xs font-bold uppercase ml-5">Login</a>
    @endauth

    <a href="#newsletter"
      class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
      style="white-space: nowrap">
      Subscribe for Updates
    </a>
  </div>
</nav>
