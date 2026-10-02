<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-20 mx-auto">
        {{-- left side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse($posts as $post)
                <x-post :post="$post" />
            @empty
                <div class="max-w-2xl mx-auto">
                    {{ __('Start following your friends and enjoy!') }}
                </div>
            @endforelse
        </div>
        {{-- right side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm gap-2">
                <div class="mr-5">
                    <a href="">
                        <img src="{{ Auth::user()->avatar }}" alt="{{ auth()->user()->username }}"
                            class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="" class="font-bold">{{ auth()->user()->username }}</a>
                    <div class="text-gray-500 text-sm">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">
                    {{ __('Suggested for you') }}
                </h3>
                <ul>
                    @foreach ($suggestedUsers as $suggested)
                        <li class="flex flex-row my-5 text-sm justify-items-center gap-2">
                            <div class="mr-5">
                                <a href="">
                                    <img src="{{ $suggested->avatar }}" alt=""
                                        class="rounded-full h-9 w-9 border border-gray-300">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="" class="font-bold text-black">{{ $suggested->username }}</a>
                                <div class="text-gray-500 text-sm">{{ $suggested->name }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>