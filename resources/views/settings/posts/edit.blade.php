<x-frontend.layout>
  <x-frontend.setting heading="Update {{ $post->title }}">
    <form method="POST" action="/settings/posts/{{ $post->slug }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf
      @method('PATCH')

      <div class="w-52 h-auto mb-4">
        <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images/illustration-1.png' }}" alt="post"
          class="mt-3 w-full h-full object-cover rounded-xl">
      </div>

      <x-frontend.form.field>
        <x-frontend.form.label name="title" />
        <x-frontend.form.input name="title" type="text" value="{{ old('title', $post->title) }}" />
        <x-frontend.form.error name="title" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="photo" />
        <x-frontend.form.input name="thumbnail" type="file" />
        <x-frontend.form.error name="thumbnail" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="category" />
        <select name="category_id" class="form-select block w-full mt-1">
          <option selected disabled>Choose Category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
              {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        <x-frontend.form.error name="category_id" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="author" />
        <select name="user_id" class="form-select block w-full mt-1">
          @foreach ($authors as $author)
            <option value="{{ $author->id }}"
              {{ old('user_id', $post->author->id) == $author->id ? 'selected' : '' }}>
              {{ ucwords($author->name) }}
            </option>
          @endforeach
        </select>
        <x-frontend.form.error name="category_id" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="status" />
        <select name="status" class="form-select block w-full mt-1">
          <option value="public" {{ old('status', $post->status) == 'public' ? 'selected' : '' }}>Public</option>
          <option value="private" {{ old('status', $post->status) == 'private' ? 'selected' : '' }}>Private</option>
        </select>
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="body" />
        <x-frontend.form.textarea name="body">
          {{ old('body', $post->body) }}
        </x-frontend.form.textarea>
        <x-frontend.form.error name="body" />
      </x-frontend.form.field>


      <x-frontend.form.button>
        Save Changes
      </x-frontend.form.button>
    </form>
  </x-frontend.setting>
</x-frontend.layout>
