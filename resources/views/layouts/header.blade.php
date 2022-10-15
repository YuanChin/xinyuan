<div class="sticky inset-x-0 top-0 z-20 bg-zinc-800 border-b border-gray-500">
    <div>
        <div class="flex flex-row items-center h-14">
            <!-- Icon -->
            <div>
                <a class="flex flex-row mx-5 text-zinc-50" href="{{ route('root') }}">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-snow2 h-8" viewBox="0 0 16 16">
                            <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793v-1.086l-.646.647a.5.5 0 0 1-.707-.708L7.5 10.293V8.866l-1.236.713-.495 1.85a.5.5 0 1 1-.966-.26l.237-.882-.94.542-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495.94-.542-.882-.237a.5.5 0 1 1 .258-.966l1.85.495L7 8l-1.236-.713-1.849.495a.5.5 0 1 1-.258-.966l.883-.237-.94-.542-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 0 1 .966-.258l.495 1.849.94.542-.236-.883a.5.5 0 0 1 .966-.258l.495 1.849 1.236.713V5.707L6.147 4.354a.5.5 0 1 1 .707-.708l.646.647V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 0 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v1.086l.647-.647a.5.5 0 1 1 .707.708L8.5 5.707v1.427l1.236-.713.495-1.85a.5.5 0 1 1 .966.26l-.236.882.94-.542.495-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495-.94.542.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l1.236.713 1.849-.495a.5.5 0 0 1 .259.966l-.883.237.94.542 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-.94-.542.236.883a.5.5 0 0 1-.966.258L9.736 9.58 8.5 8.866v1.427l1.354 1.353a.5.5 0 0 1-.707.708l-.647-.647v1.086l1.354 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z"/>
                        </svg>
                    </div>
                    <h1 class="flex items-center text-2xl ml-2">XinYuan</h1>
                </a>
            </div>

            <!-- Items -->
            <div class="flex-1">
                <div class="flex flex-row sm:justify-between justify-end">
                    <div class="hidden sm:flex sm:flex-1 items-center">
                        <div class="relative w-1/2">
                            <input
                                type="search"
                                class="w-full h-10 pl-4 pr-10 text-sm bg-zinc-700 border-none rounded-lg focus:outline-none" 
                                placeholder="搜尋"
                            >
                            <button
                                class="absolute top-1/2 right-1 -translate-y-1/2 px-2 text-zinc-400 hover:text-zinc-100"
                                type="button"
                                aria-label="Submit Search"
                            >
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        @guest
                        <div class="mx-4">
                            <a
                                class="block px-5 py-2.5 border border-sky-500 text-sky-500 hover:opacity-50 transition-all duration-300"
                                href="{{ route('login') }}"
                            >
                                <p>登入</p>
                            </a>
                        </div>
                        @else
                        <div class="flex flex-row mx-4">
                            <div class="flex items-center mr-6 text-zinc-50">
                                <x-posts.create></x-posts.create>
                                <x-users.notification
                                    size="w-[400px] h-[400px]"
                                    position="top-[40px] right-0"
                                    contentClasses="bg-zinc-800 opacity-80 text-zinc-50"
                                ></x-users.notification>
                            </div>
                            <div class="flex items-center">
                                <x-dropdown
                                    size="w-72"
                                    position="right-0 top-[56px]"
                                    contentClasses="bg-zinc-800 border-x border-b border-gray-400 opacity-80 text-zinc-50"
                                >
                                    
                                    <x-slot name="trigger">
                                        <img src="{{ Auth()->user()->avatar }}" alt="{{ Auth()->user()->name }}" class="rounded-full w-10 h-10">
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="flex flex-row justify-start p-4 border-b border-gray-400">
                                            <div class="flex items-center mr-4">
                                                <img src="{{ Auth()->user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-full w-12 h-12">
                                            </div>
                                            <div class="flex justify-center items-center">
                                                <div class="text-xl">
                                                    <span><strong>{{ Auth()->user()->name }}</strong></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col">
                                            <x-dropdown-link>
                                                <div class="flex flex-row">
                                                    <div class="flex justify-start items-center w-8">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                    <span>{{ __('個人中心') }}</span>
                                                </div>
                                            </x-dropdown-link>
                                            <x-dropdown-link>
                                                <div class="flex flex-row">
                                                    <div class="flex justify-start items-center w-8">
                                                        <i class="bi bi-file-earmark-text-fill"></i>
                                                    </div>
                                                    <span>{{ __('內容管理') }}</span>
                                                </div>
                                            </x-dropdown-link>
                                            <x-dropdown-link >
                                                <div class="flex flex-row">
                                                    <div class="flex justify-start items-center w-8">
                                                        <i class="bi bi-pencil"></i>
                                                    </div>
                                                    <span>{{ __('編輯資料') }}</span>
                                                </div>
                                            </x-dropdown-link>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    <div class="flex flex-row">
                                                        <div class="flex justify-start items-center w-8">
                                                            <i class="bi bi-box-arrow-right"></i>
                                                        </div>
                                                        <span>{{ __('登出') }}</span>
                                                    </div>
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                        
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>