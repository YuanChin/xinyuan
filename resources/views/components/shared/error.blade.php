@if (count($errors) > 0)
<div
    x-data="{
        automaticallyClose: null,
        runProgressBar: null,
        timeout: 3000,
        percent: 0,
        isShow: true,
        close() {
            this.isShow = false;
            clearInterval(this.runProgressBar);
        },
        init() {
            if (this.automaticallyClose) {
                clearTimeout(this.automaticallyClose);
                this.automaticallyClose  = null;
            }

            if (this.runProgressBar) {
                clearInterval(this.runProgressBar);
                this.runProgressBar = null;
            }
    
            this.automaticallyClose = setTimeout(() => {
                this.isShow = false;
            }, this.timeout);

            const startDate = Date.now();
            this.runProgressBar = setInterval(() => {
                const date = Date.now();

                this.percent = (date - startDate) * 100 / this.timeout;

                if (this.percent >= 100) {
                    clearInterval(this.runProgressBar);
                    this.runProgressBar = null;
                }
            }, 30);
        }

    }"
    x-show="isShow"
    class="relative bg-red-50 border-l-8 border-red-900 mb-4"
>
    <div class="flex items-center">
        <div class="p-2">
            <div class="flex items-center">
                <div
                    @click="close()"
                    class="ml-2"
                >
                    <svg class="h-8 w-8 text-red-900 mr-2 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="px-6 py-4 text-red-900 font-semibold text-lg">有錯誤發生：</p>
            </div>
            <div class="px-16 mb-4">
                @foreach ($errors->all() as $error)
                <li class="text-md font-bold text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>
    <div
        class="absolute left-0 bottom-0 right-0 h-[6px] bg-red-400/50"
        :style="{'width': `${percent}%`}"
    ></div>
</div>
@endif