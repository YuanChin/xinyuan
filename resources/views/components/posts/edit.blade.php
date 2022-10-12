@props([
    'class' => 'cursor-pointer block p-4 leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-700 transition duration-150 ease-in-out',
    'post'
])
<div>
    <a href="{{ route('posts.edit', $post->id) }}" class="{{ $class }}">
        <div class="flex flex-row">
            <div class="flex justify-start w-8">
                <i class="bi bi-pencil-square"></i>
            </div>
            <span>{{ __('編輯') }}</span>
        </div>
    </a>
</div>