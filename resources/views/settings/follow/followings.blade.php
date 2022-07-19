<x-frontend.follow-table>
  <x-slot name="tbody">
    @forelse ($followings as $following)
      <tr>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
              <img class="h-10 w-10 rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
            </div>
            <div class="ml-4">
              <div class="text-sm font-medium text-gray-900">
                {{ $following->name }}
              </div>
              <div class="text-sm text-gray-500">
                {{ $following->email }}
              </div>
            </div>
          </div>
        </td>

        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900">
              <form action="/settings/followings/{{ $following->id }}" method="POST">
                @csrf
                @method('DELETE')
                <x-frontend.following-button>
                  following
                </x-frontend.following-button>
              </form>
            </div>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="3" class="px-4 py-3">
          <p class="text-center text-gray-500 text-sm">
            You don't follow yet any author.If you want to follow, go to
            <a class="text-blue-500" href="/settings/authors">follow</a>.
          </p>
        </td>
      </tr>
    @endforelse
  </x-slot>
  <x-slot name="pagination">
    {{ $followings->links('', ['type' => 'followings']) }}
  </x-slot>
</x-frontend.follow-table>
