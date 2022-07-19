<x-frontend.layout>
  <main class="w-full max-w-md mx-auto" style="margin-top: 5rem">
    <form method="POST" action="/login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf
      <h1 class="font-bold text-xl mb-10">Login</h1>
      <x-frontend.form.field>
        <x-frontend.form.label name="email" />
        <x-frontend.form.input name="email" type="email" autocomplete="username" />
        <x-frontend.form.error name="email" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="password" />
        <x-frontend.form.input name="password" type="password" autocomplete="username" />
        <x-frontend.form.error name="password" />
      </x-frontend.form.field>

      <x-frontend.form.button>
        Login
      </x-frontend.form.button>
    </form>
  </main>
</x-frontend.layout>
