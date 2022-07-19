@props(['name'])

<label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
  {{ ucwords($name) }}
</label>
