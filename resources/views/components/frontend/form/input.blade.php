@props(['name'])

<input class="border @error($name) border-red-500 @enderror shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
  id="{{ $name }}"
  name="{{ $name }}"
  placeholder="{{ ucwords($name) }}"
  {{ $attributes(['value' => old($name)]) }}>
