@props(['position' => '', 'size' => '', 'contentClasses' => ''])

<div
    x-data="{
        isOpen: false,
        result: {},
        notification_count: $persist(0),
        change() {
            this.isOpen = !this.isOpen;
        },
        close() {
            this.isOpen = false;
        },
        async getNotification() {
            let response = await (await fetch('{{ route('notifications.index') }}')).json();
            this.result = response.data;
        }
    }"
    @set-notification-count.window="notification_count = $event.detail.count"
    @click.outside="close()"
    @close.stop="close()"
    class="relative"
>
    <div @click="
        change();
        if (isOpen) {
            getNotification();
            notification_count = 0;
        }
    ">
        <div class="cursor-pointer relative px-[10px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bell w-5 h-5" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>
            <span
                x-show="notification_count > 0"
                x-text="notification_count"
                style="display: none;"
                class="absolute -top-[8px] right-0 text-xs font-bold leading-none px-[4px] py-[3px] text-red-100 bg-red-600 rounded-full" 
            ></span>
        </div>
    </div>

    <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-20 shadow-xl {{ $size }} {{ $position }} {{ $contentClasses }} overflow-y-auto"
            style="display: none;"
            @click="close()">
        <div class="flex flex-col">
            <div class="sticky top-0 z-10 w-full bg-zinc-800 py-[13px] px-4">
                <h1 class="flex flex-1 font-medium leading-6 overflow-hidden">通知</h1>
            </div>
            <div>
            <template x-for="notification in result" :key="notification.id">
                <div class="relative flex flex-row gap-2 px-2 py-4">
                    <div class="flex shrink-0">
                        <img :src="notification.data.user_avatar" class="rounded-full w-10 h-10">
                    </div>
                    <div class="flex flex-1 pr-1 pl-2">
                        <div>
                            <a :href="notification.data.post_link"
                                class="after:content-[''] after:absolute after:inset-0 after:hover:bg-zinc-400 after:opacity-30"
                            >
                                <p>
                                    <strong x-text="notification.data.user_name"></strong> 評論您的文章 <strong>『<strong x-text="notification.data.post_title"></strong>』</strong>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
            </div>
        </div>
    </div>
</div>