<x-frontend.layout>
  <main class="w-full max-w-md mx-auto" style="margin-top: 5rem">
    <form method="POST" action="/register" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf
      <h1 class="font-bold text-xl mb-10">Register</h1>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input class="border @error('name') border-red-500 @enderror shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="name"
          name="name"
          type="text"
          placeholder="Name"
          value="{{ old('name') }}">
        @error('name')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
          Username
        </label>
        <input class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="username"
          name="username"
          type="text"
          placeholder="Username"
          value="{{ old('username') }}">
        @error('username')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Email
        </label>
        <input class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="email"
          name="email"
          type="email"
          placeholder="Email"
          value="{{ old('email') }}">
        @error('email')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input
          class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="password"
          name="password"
          type="password"
          placeholder="Password">
        @error('password')
          <p class="text-red-500 text-xs mt-2">Please choose a password.</p>
        @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Register
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          Forgot Password?
        </a>
      </div>

      {{-- @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
          @endforeach
        </ul>
      @endif --}}
    </form>
  </main>
</x-frontend.layout>
