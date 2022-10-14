@props([
    'class' => 'cursor-pointer block p-4 leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-700 transition duration-150 ease-in-out',
    'reply'
])
<div
    x-data="{
        result: {},
        async deleteReply(url) {
            this.result = await (await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                }
            })).json();

            if (this.result.status === 0) {
                Toast.fire({
                    icon: 'success',
                    title: this.result.message
                }).then(function () {
                    window.location.reload();
                })
            }
        }
    }"
>
    <a
        @click="
            Swal.fire({
                icon: 'warning',
                title: '確定要刪除該則留言？',
                showCancelButton: true,
                confirmButtonText: '確定',
                cancelButtonText: '取消',
            }).then(function (sign) {
                if (sign.isConfirmed) {
                    deleteReply('{{ route('replies.destroy', $reply->id) }}');
                }
            });
        "
        class="{{ $class }}"
    >
        <div class="flex flex-row">
            <div class="flex justify-start w-8">
                <i class="bi bi-trash3-fill"></i>
            </div>
            <span>{{ __('刪除') }}</span>
        </div>
    </a>
</div>