@props(['post'])
<div
    x-data="{
        isShow: false,
        isViewHeight: false,
        formData: {
            user_id: {{ Auth::id() }},
            post_id: {{ $post->id }},
            content: '',
        },
        open() {
            this.isShow = true;
        },
        close() {
            this.isShow = false;
        },
        triggerViewHeight() {
            this.isViewHeight = !this.isViewHeight;
        },
        async reply(url) {
            let response = await (await fetch(url , {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-type': 'application/json; charset=UTF-8',
                },
                body: JSON.stringify(this.formData)
            })).json();

            if (response.status === 0) {
                Toast.fire({
                    icon: 'success',
                    title: response.message
                }).then(function () {
                    window.location.reload();
                })
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.message
                })
            }
        }
    }"
>
    <div
        x-show="!isShow"
    >
        <div class="w-full">
            <div>
                <div class="relative flex items-center justify-end h-14 px-[60px]">
                    <div
                        @click="open()"
                        class="flex items-center flex-1 h-full cursor-text"
                    >
                        <div class="mr-[10px]">
                            <img src="{{ Auth()->user()->avatar }}" alt="{{ Auth()->user()->name }}" class="rounded-full w-8 h-8">
                        </div>
                        留言......
                    </div>
                    <div class="flex-shrink-0 h-full">
                        <div class="flex items-center h-full">
                            <button class="h-full px-2 border-none outline-none text-zinc-500" title="收藏">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bookmark-fill w-5 h-5" viewBox="0 0 16 16">
                                    <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        x-show="isShow"
        style="display: none;"   
    >
        <div class="w-full">
            <div>
                <div :class="isViewHeight ? 'h-screen' : 'h-[264px]'">
                    <div class="h-full">
                        <form class="flex flex-col h-full">
                            <div class="py-4 px-[60px]">
                                <div class="flex">
                                    <div class="flex flex-1 items-center">
                                        <div class="py-4">
                                            <img src="{{ Auth()->user()->avatar }}" alt="{{ Auth()->user()->name }}" class="rounded-full w-8 h-8">
                                        </div>
                                    </div>
                                    <div class="flex items-center px-2">
                                        <template x-if="!isViewHeight">
                                            <div
                                                @click="triggerViewHeight()"
                                            >
                                                <i class="bi bi-arrows-angle-expand"></i>
                                            </div>
                                        </template>
                                        <template x-if="isViewHeight">
                                            <div
                                                @click="triggerViewHeight()"
                                            >
                                                <i class="bi bi-arrows-angle-contract"></i>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full h-full px-[60px]">
                                <div
                                    @input="
                                        if ($event.target.innerHTML.length === 0) {
                                            $event.target.classList.add('before:content-[attr(placeholder)]');
                                        } else {
                                            $event.target.classList.remove('before:content-[attr(placeholder)]');
                                        }

                                        formData.content = $event.target.innerHTML;
                                    "
                                    x-trap="isShow"
                                    class="before:content-[attr(placeholder)] focus:outline-none overflow-y-auto"
                                    :class="isViewHeight ? 'h-[450px]' : 'h-[104px]'"
                                    contenteditable="true"
                                    placeholder="請輸入您的留言"
                                ></div>
                            </div>

                            <div class="flex items-center justify-between h-[68px] px-[60px] py-3">
                                <div class="flex items-center">
                                    <i class="bi bi-image"></i>
                                </div>
                                <div class="flex">
                                    <button
                                        @click.prevent="close()"
                                        class="cursor-pointer p-2"
                                    >
                                        <div>取消</div>
                                    </button>
                                    <button
                                        @click.prevent="reply('{{ route('replies.store') }}')"
                                        class="cursor-pointer p-2 ml-2 bg-zinc-500 rounded-xl"
                                    >
                                        <div>送出</div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>