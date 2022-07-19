@props(['trigger', 'width' => 'auto'])

<div x-data="{ show: false }" class="w-full relative" style="min-width: {{ $width }}">
  {{-- Trigger --}}
  <div @click="show = !show" @click.away="show = false">{{ $trigger }}</div>

  {{-- Links --}}
  <div x-show="show" x-transition class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50 overflow-auto max-h-52" style="display: none">
    {{ $slot }}
  </div>
</div>
