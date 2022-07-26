<x-frontend.layout>
  <x-frontend.setting heading="Followers">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Author
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">follow</span>
                  </th>
                </tr>
              </thead>

              <tbody class="bg-white divide-y divide-gray-200">
                {{ $tbody }}
              </tbody>
            </table>
          </div>
          <div class="mt-5">
            {{ $pagination }}
          </div>
        </div>
      </div>
    </div>
  </x-frontend.setting>
</x-frontend.layout>
