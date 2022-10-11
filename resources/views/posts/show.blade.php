<x-app-layout>
    <div>
        <!-- 分類選項 -->
        <div class="hidden fixed inset-0 top-14 md:block w-[19.5rem] bg-zinc-800 overflow-y-auto">
            <div class="flex flex-col text-zinc-50">
                <div class="border-b-[0.5px] border-gray-500">
                    <div class="my-4">
                        <a href="">
                            <div class="block hover:bg-zinc-600 hover:opacity-80">
                                <div class="flex items-center h-14 pl-6 pr-3">
                                    <div class="block overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-card-list w-5 h-[30px]" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-2 mr-[10px] overflow-hidden">
                                        全部看板
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="block hover:bg-zinc-600 hover:opacity-80">
                                <div class="flex items-center h-14 pl-6 pr-3">
                                    <div class="block overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-shop w-5 h-[30px]" viewBox="0 0 16 16">
                                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-2 mr-[10px] overflow-hidden">
                                        購物商場
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>   
                </div>
                <x-posts.category></x-posts.category>
            </div>
        </div>

        <!-- 內容區 -->
        <div class="md:pl-[19.5rem]">
            <div class="flex flex-row my-5 mx-4">
                <div class="flex-1 max-w-[796px]">
                    @include("posts.parts.post")
                </div>
            </div>
        </div>
    </div>
</x-app-layout>