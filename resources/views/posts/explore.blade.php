<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="{{ url('/posts/' . $post->slug) }}">
                    <img
                        src="{{ asset('storage/' . $post->image) }}"
                        alt="{{ $post->title }}"
                        class="w-full h-64 object-cover rounded"
                    >
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-5 pb-3">
        {{ $posts->links() }}
    </div>
</x-app-layout>