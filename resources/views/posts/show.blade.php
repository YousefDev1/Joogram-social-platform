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
                            {{$post->created_at->diffForHumans(null, true, true)}}
                        </div>
                    </div>
                </div>
                {{-- comments --}}
                @foreach ($post->comments as $comment)
                    <div class="flex items-start px-5 py-2 gap-2">
                        <img src="{{$comment->owner->avatar}}" alt="user image"
                            class="w-10 h-10 rounded-full ltr:mr-5 rtl:mr-5">
                        <div class="flex flex-col">
                            <div>
                                <a href="" class="font-bold mr-2 inline-block">
                                    {{$comment->owner->username}}</a>
                                <span class="inline">{{$comment->body}}</span>
                            </div>
                            <div class="mt-1 font-sm text-gray-400">
                                {{ $comment->created_at->diffForHumans(null, true, true) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t p-5">
                <form action="{{ route('comment.store', $post) }}" method="POST">
                @csrf
                @if($errors->has('body'))
                <div class="text-red-500 mb-2 text-sm">
                    {{ $errors->first('body') }}
                </div>
                @endif
                <div class="flex flex-row">
                    <textarea name="body" id="comment_body" placeholder="{{__('Add a comment ...')}}" required
                    class="h-7 grow resize-none border-none overflow-hidden bg-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                <button type="submit" class="lrt:ml-5 rtl:mr-5 border-none bg-white text-blue-500"
                >{{ __('Comment') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>