<div class="w-full min-h-screen text-zinc-50">
    <div class="flex flex-col w-full min-h-screen bg-zinc-800">
        <div class="pt-6"></div>
        <div class="relative px-[60px] py-4">
            <a
                href=""
                class="flex items-center gap-2"
            >
                <div>
                    <img class="w-[40px] h-[40px] rounded-full" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                </div>
                
                <p>{{$post->user->name}}</p>
            </a>
            @can('update', $post)
            <div class="absolute right-5 top-6">
                <x-dropdown
                    size="w-24"
                    position="-left-[80px] top-[40px]"
                    contentClasses="bg-zinc-900 opacity-80 text-zinc-50"
                >
                    <x-slot name="trigger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-three-dots-vertical w-6 h-6" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        </svg>
                    </x-slot>
                    <x-slot name="content">
                        <div class="flex flex-col py-2">
                            <x-posts.edit
                                :post="$post"
                            ></x-posts.edit>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            @endcan
        </div>
        <div class="pb-[6px]"></div>
        <div class="px-[60px]">
            <div class="flex items-center text-3xl leading-[54px]">
                <h1>{{ $post->title }}</h1>
            </div>
            <div class="relative flex items-center mt-3">
                <div class="block">
                    <a
                        href="{{ $post->category->showLink() }}"
                        class="text-sky-400"
                    >
                        {{ $post->category->name }}
                    </a>
                </div>
                <div class="block text-zinc-400 before:content-['·'] before:px-2">
                    {{ $post->updated_at->locale('zh_TW')->isoFormat('MMM Do hh:mm') }}
                </div>
                <div class="absolute flex items-center right-0">
                    <div class="block">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div class="block text-zinc-400 before:content-[''] before:px-1 text-sm">
                        {{ $post->view_count }}
                    </div>
                </div>
            </div>
            <div class="pt-5 pb-10 text-zinc-200 leading-8">
                {!! $post->body !!}
            </div>
        </div>
    </div>
</div>