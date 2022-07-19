<x-frontend.layout>
  <x-frontend.setting heading="All Posts">
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
                    Privacy
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $post)
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
                      <span class="{{ $post->status == 'public' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                        {{ ucwords($post->status) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="/admin/posts/{{ $post->slug }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <form method="POST" action="/admin/posts/{{ $post->slug }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-indigo-300 hover:text-indigo-900">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
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
