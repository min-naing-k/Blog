@if (session('success'))
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
    class="transition-all">
    <p class="transition-all fixed bottom-3 right-3 bg-blue-500 text-white px-3 py-4 rounded-xl">
      {{ session('success') }}
    </p>
  </div>
@endif
