@props(['name'])

<textarea name="{{ $name }}" id="{{ $name }}"
  class="border @error('title') border-red-500 @enderror shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="5"
  placeholder="Enter Your Content...">{{ $slot ?? old($name) }}</textarea>
