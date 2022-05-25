<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('歡迎您成為 ') . env('APP_NAME') . __(' 的會員，請在以下輸入您的驗證碼來認證信箱！') }}
        </div>

        @if(session()->has('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-4 flex items-end justify-between">
            <div>
                <form method="POST" action="{{ route('verification.verify') }}">
                    @csrf
                    <div class="flex flex-col">
                        <x-label for="verification_code_field" :value="__('驗證碼')" />
                        <x-input
                            id="verification_code_field"
                            type="text" name="verification_code"
                            class="mt-1"
                        />
                    </div>  
                    <button
                        type="submit"
                        class="mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('提交') }}
                    </button>
                </form>
            </div>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div>
                    <x-button>
                        {{ __('重新發送驗證碼') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-app-layout>