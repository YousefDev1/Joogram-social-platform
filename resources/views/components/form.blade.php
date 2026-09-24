@if (isset($post) && $post->image)
<div class="mb-4">
    <img src="{{ asset('storage/'. $post->image) }}" alt="post image" class="w-32 h-32 object-cover rounded-xl">
</div>
@endif

<input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-lg" type="file" name="image"
    id="file_input">
<p class="mt-2 text-gray-500 text-sm dark::text-gray-300" id="file_input_help">PNG,JPG or GIF</p>

<textarea name="description" rows="5" class="mt-10 w-full border border-gray-200 rounded-xl"
    placeholder="{{ __('Write a description') }}">{{ old('description', $post->description ?? ' ' ) }}</textarea>