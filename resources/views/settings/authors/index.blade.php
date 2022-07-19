<x-frontend.follow-table>
  <x-slot name="tbody">
    @foreach ($authors as $author)
      <tr>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
              <img class="h-10 w-10 rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
            </div>
            <div class="ml-4">
              <div class="text-sm font-medium text-gray-900">
                {{ $author->name }}
              </div>
              <div class="text-sm text-gray-500">
                {{ $author->email }}
              </div>
            </div>
          </div>
        </td>

        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900">
              <form action="/settings/followings/{{ $author->id }}" method="POST">
                @csrf
                <x-frontend.follow-button>
                  follow
                </x-frontend.follow-button>
              </form>
            </div>
          </div>
        </td>
      </tr>
    @endforeach
  </x-slot>
  <x-slot name="pagination">
    {{ $authors->links('vendor.pagination.custom_pagination') }}
  </x-slot>
</x-frontend.follow-table>
