<div class="flex flex-col border-2 border-transparent bg-zinc-800">
    <div class="sticky z-10 top-[57px] px-[44px] pt-[20px] border-b border-gray-500 bg-zinc-800 text-zinc-50">
        <div class="w-full">
            <div class="flex items-center h-[60xp]">
                <div class="flex flex-grow-0 h-full">
                    <div class="relative flex items-center justify-start w-full h-full">
                        <a href="" class="relative h-[60px] px-4 font-medium leading-[60px]">全部</a>
                        <a href="" class="relative h-[60px] px-4 font-medium leading-[60px]">追蹤</a>
                    </div>
                </div>
                <div class="flex flex-grow justify-end h-full">
                    <div class="flex items-center justify-center">
                        <div class="px-[10px]">文章排序依</div>
                        <div>
                                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach($posts as $post)
        <div>
            <div class="relative flex flex-col py-5 mx-[60px] {{ $loop->last ? '' : 'border-b border-gray-500' }}">
                <div>
                    <div class="flex items-center pb-4 text-zinc-50">
                        <div class="flex-shrink-0 mr-2">
                            <img 
                                src="{{ $post->user->avatar }}"
                                alt="{{ $post->user->name }}"
                                class="rounded-full w-5 h-5"
                            >
                        </div>
                        <div class="flex flex-1 overflow-hidden">
                            <div class="flex items-center leading-5 overflow-hidden">
                                <div class="flex items-center overflow-hidden after:content-['・']">
                                    {{ $post->category->name }}
                                </div>
                                <div class="flex items-center overflow-hidden after:content-['・']">
                                    {{ $post->user->name }}
                                </div>
                                <div class="flex items-center overflow-hidden">
                                    {{ $post->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>
                    <a href="{{ $post->showLink() }}" class="after:content-[''] after:absolute after:inset-0">
                        <span class="text-lg font-semibold text-zinc-50">{{ $post->title }}</span>
                    </a>
                </h2>
                <div>
                    <div class="text-sm text-zinc-400">
                        <span>{!! Str::limit($post->body, 100, $end = '...') !!}</span>
                    </div>
                </div>
                <div class="flex items-center pt-4 text-zinc-500">
                    <div class="flex items-center pr-4">
                        <div class="block">
                            <i class="bi bi-heart-fill text-red-600"></i>
                        </div>
                        <div class="block px-1 text-sm">
                            {{ $post->reply_count }}
                        </div>
                    </div>
                    <div class="flex items-center pr-4">
                        <div class="block">
                            <i class="bi bi-chat-fill text-zinc-50"></i>
                        </div>
                        <div class="block px-1 text-sm">
                            {{ $post->reply_count }}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="block">
                            <i class="bi bi-bookmark-fill"></i>
                        </div>
                        <div class="block px-1 text-sm">
                            收藏
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach           
        {!! $posts->appends(Request::except('page'))->onEachSide(1)->links() !!}
    </div>
</div>