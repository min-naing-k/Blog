<x-frontend.layout>
  <x-frontend.setting heading="Create New Post">
    <form method="POST" action="/admin/posts" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf

      <x-frontend.form.field>
        <x-frontend.form.label name="title" />
        <x-frontend.form.input name="title" type="text" />
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
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <x-frontend.form.error name="category_id" />
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="privacy" />
        <select name="status" class="form-select block w-full mt-1">
          <option value="public" {{ old('status') == 'public' ? 'selected' : '' }}>Public</option>
          <option value="private" {{ old('status') == 'private' ? 'selected' : '' }}>Private</option>
        </select>
      </x-frontend.form.field>

      <x-frontend.form.field>
        <x-frontend.form.label name="body" />
        <x-frontend.form.textarea name="body">{{ old('body') }}</x-frontend.form.textarea>
        <x-frontend.form.error name="body" />
      </x-frontend.form.field>


      <x-frontend.form.button>
        Publish
      </x-frontend.form.button>
    </form>
  </x-frontend.setting>
</x-frontend.layout>
