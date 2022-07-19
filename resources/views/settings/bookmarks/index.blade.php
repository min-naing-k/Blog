<x-frontend.layout>
  <x-frontend.setting heading="My Bookmarks Posts">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Author
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Remove</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($posts as $post)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                          <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                          </a>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                          {{ $post->author->name }}
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <form method="POST" action="/posts/{{ $post->slug }}/bookmark">
                        @csrf

                        <button type="submit" class="text-indigo-300 hover:text-indigo-900">Remove</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="p-4">
                      <p class="text-center text-gray-500 text-sm">No Save Yet.. Want to save a post ? <a href="/" class="text-blue-500">Go to save a post</a></p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-5">
            {{ $posts->links('', ['type' => 'posts']) }}
          </div>
        </div>
      </div>
    </div>
  </x-frontend.setting>
</x-frontend.layout>
