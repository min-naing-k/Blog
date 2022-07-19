<x-frontend.follow-table>
  <x-slot name="tbody">
    @forelse ($followers as $follower)
      <tr>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
              <img class="h-10 w-10 rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
            </div>
            <div class="ml-4">
              <div class="text-sm font-medium text-gray-900">
                {{ $follower->name }}
              </div>
              <div class="text-sm text-gray-500">
                {{ $follower->email }}
              </div>
            </div>
          </div>
        </td>

        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900">
              @if ($follower->isFollow)
                <form action="/settings/followings/{{ $follower->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <x-frontend.following-button>
                    following
                  </x-frontend.following-button>
                </form>
              @else
                <form action="/settings/followings/{{ $follower->id }}" method="POST">
                  @csrf
                  <x-frontend.follow-button>
                    follow
                  </x-frontend.follow-button>
                </form>
              @endif
            </div>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="3" class="px-4 py-3">
          <p class="text-center text-gray-500 text-sm">
            You don't have yet any followers.If you want a follower, go to
            <a class="text-blue-500"
              href="{{ auth()->user()->username === 'minnaingkyaw' ? '/admin/posts/create' : '/settings/posts/create' }}">
              post
            </a>
            a awesome blog.
          </p>
        </td>
      </tr>
    @endforelse
  </x-slot>
  <x-slot name="pagination">
    {{ $followers->links('', ['type' => 'followers']) }}
  </x-slot>
</x-frontend.follow-table>
