<x-app-layout>
<div class="my-8 container max-w-2xl mx-auto shadow-md md:w-3/4 rounded-b-lg border-b-2 border-indigo-400">
    <div class="p-4 bg-gray-100 border-t-2 border-indigo-400 bg-opacity-5 rounded-lg">
        <div class="max-w-sm mx-auto md:w-full md:mx-0">
            <div class="inline-flex items-center space-x-4">
                <a href="#" class="block relative">
                    <img alt="profil" src="https://bruce-fe-fb.web.app/image/avator.png" class="mx-auto object-cover rounded-full h-16 w-16 "/>
                </a>
                <h1 class="text-gray-600">
                    {{ $user->name }}
                </h1>
            </div>
        </div>
    </div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4 mx-4" :errors="$errors" />
    <form action="{{ route('users.update', $user->id) }}"
        method="POST" accept-charset="UTF-8"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="space-y-6 bg-white rounded-b-lg">
            <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3">
                    <span>名稱</span>
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class="relative">
                        <x-input
                            id="user-name"
                            type="text" name="name"
                            class="w-full"
                            placeholder="請輸入您的名稱"
                            value="{{ old('name', $user->name) }}"
                        />
                    </div>
                </div>
            </div>
            <hr/>
            <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3">
                    <span>信箱</span>
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class="relative">
                        <x-input
                            id="user-email"
                            type="email" name="email"
                            class="w-full"
                            placeholder="請輸入您的信箱"
                            value="{{ old('email', $user->email) }}"
                        />
                    </div>
                </div>
            </div>
            <div class="max-w-sm mx-auto md:max-w-2xl md:w-11/12">
                <textarea class="border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                    id="user-introduction" placeholder="個人簡介" name="introduction" rows="5" cols="40"
                >{{ old('introduction', $user->introduction) }}</textarea>
            </div>
            <div class="w-full p-6 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                <div class="flex w-full items-center justify-start">
                    <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">選擇圖片</span>
                        <input type='file' name="avatar" class="hidden" />
                    </label>
                </div>
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" width="200" />
                @endif
            </div>
            
            <div class="w-full px-4 pb-4 ml-auto text-gray-500 md:w-1/3">
                <button type="submit" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                    <span>保存</span>
                </button>
            </div>
        </div>
    </form>
</div>
</x-app-layout>