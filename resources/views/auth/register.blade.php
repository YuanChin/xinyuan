<x-auth-layout>
    <div class="relative min-h-screen flex ">
        <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
            
            <div class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto bg-no-repeat bg-cover relative"
                 style="background-image: url(https://i0.hippopx.com/photos/506/770/394/hong-kong-city-urban-skyscrapers-preview.jpg);">
                <div class="absolute bg-gradient-to-b from-gray-900 to-gray-500 opacity-75 inset-0 z-0"></div>
                <!---remove custom style-->
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div class="md:flex md:flex-col md:items-center md:justify-center w-full sm:w-auto md:h-full xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
                <div class="flex justify-end items-center w-full">
                    <a class="p-2 hover:-translate-x-1 ease-in-out duration-500" href="{{ url('/') }}" title="首頁">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                    </a>
                </div>
                <div class="max-w-md w-full space-y-10">
                    <div class="text-center">
                        <h2 class="mt-6 text-4xl font-bold text-gray-900">
                            <span>XinyuanBlog</span>
                        </h2>
                        <p class="mt-5 text-base text-gray-500">
                            <span>註冊系統</span>
                        </p>
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <span class="h-px w-16 bg-gray-200"></span>
                        <span class="text-gray-300 font-normal">我是分隔線</span>
                        <span class="h-px w-16 bg-gray-200"></span>
                    </div>

                    <div class="h-px w--full bg-gray-200"> </div>
                    
                    <!-- registration page -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <x-floating-input
                            :id="__('name_field')"
                            :name="__('name')"
                            :content="__('請輸入您的姓名')"
                            :value="old('name')"
                            required
                        >

                        </x-floating-input>

                        <!-- Email Address -->
                        <x-floating-input
                            :id="__('email_field')"
                            :type="__('email')"
                            :name="__('email')"
                            :content="__('請輸入您的信箱')"
                            :value="old('email')"
                            required
                        >

                        </x-floating-input>


                        <!-- Password -->
                        <x-floating-input
                            :id="__('password_field')"
                            :type="__('password')"
                            :name="__('password')"
                            :content="__('請輸入您的密碼')"
                            required autocomplete="new-password"
                        >

                        </x-floating-input>

                        <!-- Confirm Password -->
                        <x-floating-input
                            :id="__('password_confirmation_field')"
                            :type="__('password')"
                            :name="__('password_confirmation')"
                            :content="__('請再次輸入您的密碼')"
                            required
                        >

                        </x-floating-input>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-auth-layout>
