<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-4 mt-8">
        {{-- Profile Avatar --}}
        <div class="md:col-span-1 flex justify-center md:justify-start">
            <img src="{{ Str::startsWith($user->avatar, ['http://', 'https://']) ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}"
                class="w-24 h-24 md:w-40 md:h-40 rounded-full object-cover border border-neutral-300">
        </div>
        {{-- Profile Information --}}
        <div class="md:col-span-3 flex flex-col gap-4">
            <div class="text-3xl font-semibold mb-2">
                {{ $user->username }}
            </div>
            @auth
            @if ($user->id == auth()->id())
                <div class="flex items-center gap-3">
                    <a href="/profile"
                        class="inline-flex items-center justify-center gap-2 rounded border border-neutral-300 px-4 py-2 text-sm font-semibold transition-colors hover:bg-neutral-50">
                        <i class="fa-regular fa-pen-to-square"></i>
                        {{ __('Edit profile') }}
                    </a>
                </div>
            @elseif(auth()->user()->isFollowing($user))
                <div>
                    <a href="{{ route('unfollow', $user->username) }}"
                        class="inline-flex items-center justify-center gap-2 rounded border border-neutral-300 px-4 py-2 text-sm font-semibold transition-colors hover:bg-neutral-50">
                        <i class="fa-solid fa-user-plus"></i>
                        {{ __('Unfollow') }}
                    </a>
                </div>
            @elseif(auth()->user()->isPending($user))
                <div>
                    <a href="{{ route('unfollow', $user->username) }}"
                        class="inline-flex items-center justify-center gap-2 rounded border border-neutral-300 px-4 py-2 text-sm font-semibold transition-colors hover:bg-neutral-50">
                        <i class="fa-solid fa-user-plus"></i>
                        {{ __('Follow') }}
                    </a>
                </div>
                @else
                    <div>
                    <a href="{{ route('follow', $user->username) }}"
                        class="inline-flex items-center justify-center gap-2 rounded border border-neutral-300 px-4 py-2 text-sm font-semibold transition-colors hover:bg-neutral-50">
                        <i class="fa-solid fa-user-plus"></i>
                        {{ __('Follow') }}
                    </a>
                </div>
            @endif
            @endauth

            @guest
                    <div>
                    <a href="{{ route('follow', $user->username) }}"
                        class="inline-flex items-center justify-center gap-2 rounded border border-neutral-300 px-4 py-2 text-sm font-semibold transition-colors hover:bg-neutral-50">
                        <i class="fa-solid fa-user-plus"></i>
                        {{ __('Follow') }}
                    </a>
                </div>
            @endguest

        </div>
        {{-- User Bio --}}
        <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!}
        </div>
        <div
            class="col-span-4 my-5 py-2 border-y border-y-natural-200 order-4 md:order-3 md:border-none md:p-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-between md:justify-start md:gap-8 md:text-xl">
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-2 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>
                    <span class="text-neutral-500 md:text-black">
                        {{ $user->posts->count() > 1 ? __('posts') : __('post') }}
                    </span>
                </li>
                <li class="flex flex-col md:flex-row text-center gap-2">
                    <div class="ltr:md:mr-1 rtl:md:ml-1 md:font-normal">
                        {{ $user->follower()->wherePivot('confirmed' , true)->get()->count() }}
                    </div>
                    <a href="" class="text-neutral-500 md:text-black">
                        {{$user->follower()->count() > 1 ? __('Followers') : __('Follower')}}
                    </a>
                </li>
                <li class="flex flex-col md:flex-row text-center gap-2">
                    <div class="ltr:md:mr-1 rtl:md:ml-1 md:font-normal">
                        {{ $user->following()->wherePivot('confirmed' , true)->get()->count() }}
                    </div>
                    <a href="" class="text-neutral-500 md:text-black">
                        {{ __('Following') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @if ($user->posts->count() > 0 && (!$user->private_account || auth()->id() == $user->id))
        <div class="grid grid-cols-3 gap-4 my-5">
            @foreach ($user->posts as $post)
                <a href="/posts/{{ $post->slug }}" class="aspect-square block w-full">
                    <div class="group relative">
                        <img src="{{ asset('storage/' . $post->image) }}" class="aspect-square object-cover w-full">
                        @if (auth()->id() === $post->user_id)
                            <div
                                class="absolute top-0 left-0 w-full h-full flex justify-center items-center group-hover:bg-black/40">
                                <ul class="invisible group-hover:visible flex flex-row">
                                    <li class="flex items-center text-2xl text-white font-bold mr-2">
                                        <i class="fa-solid fa-heart"></i>
                                        <span> 10</span>
                                    </li>
                                    <li class="flex items-center text-2xl text-white font-bold mr-2">
                                        <i class="fa-solid fa-comment"></i>
                                        <span>{{ $post->comments->count() }}</span>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="w-full mt-20">
            @if ($user->private_account && $user->id != auth()->id())
                {{ __('This Account is private follow to see posts') }}
            @else
                {{ __('No posts to show') }}
            @endif
        </div>
    @endif
</x-app-layout>