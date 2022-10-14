<div class="flex flex-col flex-1 px-[60px] pt-10 bg-zinc-700/20">
    <div>
        <div class="border-b border-zinc-700 pb-1 font-normal">
            共 {{ $post->reply_count }} 留言
        </div>
    </div>
    <div class="pt-6"></div>
    @foreach($replies as $index => $reply)
        <div>
            <div class="block pt-5 pb-4">
                <div>
                    <div class="flex flex-row">
                        <div class="shrink-0 pr-2">
                            <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="rounded-full w-10 h-10">
                        </div>
                        <div class="flex flex-col flex-1 gap-2">
                            <div class="flex flex-row justify-between">
                                <div class="">{{ $reply->user->name }}</div>
                                @can('destroy', $reply)
                                <div>
                                    <x-dropdown
                                        size="w-24"
                                        position="-left-[80px] top-[30px]"
                                        contentClasses="bg-zinc-900 opacity-80 text-zinc-50"
                                    >
                                        <x-slot name="trigger">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-three-dots-vertical w-5 h-5" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                        </x-slot>
                                        <x-slot name="content">
                                            <div class="flex flex-col py-2">
                                                <x-replies.delete
                                                    :reply="$reply"
                                                ></x-replies.delete>
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                @endcan
                            </div>
                            <div>{!! $reply->content !!}</div>
                            <div class="flex flex-row items-center pt-1 text-zinc-400 text-sm overflow-hidden">
                                <div>B{{ $index+1 }}</div>
                                <div class="block before:content-['·'] before:px-1">
                                    {{ $reply->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @unless ($loop->last)
            <div class="border-b border-zinc-700 pb-4"></div>
            @else
            <div class="border-b border-zinc-700 pb-4"></div>
            <div class="py-10"></div>
            @endunless
        </div> 
    @endforeach
</div>