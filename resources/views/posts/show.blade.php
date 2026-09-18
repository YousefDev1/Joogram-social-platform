<x-app-layout>
    <div class="h-screen md:flex md:flex-row">

    {{-- left side : image --}}
        <div class="flex items-center overflow-hidden bg-black md:w-7/12">
            <img src="{{asset('storage/' . $post->image)}}" alt="{{ $post->description }}" class="object-cover w-full">
        </div>
    {{-- right side --}}
        <div class="flex flex-col w-full bg-white md:w-5/12">
            {{-- top of right side --}}
            <div class="border-b-2">
                <div class="flex items-center p-5 g-0">
                    <img src="{{ $post->owner->avatar }}" alt="{{ $post->owner->username }}"
                    class="mr-5 h-10 w-10 rounded-full">
                    <div class="grow">
                        <a href="" class="font-bold">
                            {{ $post->owner->username }}
                        </a>
                    </div>
                </div>
            </div>
            {{-- middle of right side --}}
            <div class="grow">
                <div class="flex items-start px-5 py-2 gap-3">
                    <img src="{{ $post->owner->avatar }}" alt="{{ $post->owner->username }}"
                    class="ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full">

                    <div class="flex flex-col">
                        <div>
                            <a href="" class="font-bold">
                                {{ $post->owner->username }}
                            </a>
                            <span class="inline">{{ $post->description }}</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">
                            {{$post->created_at->diffForHumans(null,true,true)}}
                        </div>
                    </div>

                    {{-- comments --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>