@props(['position' => '', 'size' => '', 'contentClasses' => ''])

<div class="relative" x-data="dropdown" @click.outside="close()" @close.stop="close()">
    <div @click="change()">
        {{ $trigger }}
    </div>

    <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 shadow-xl {{ $size }} {{ $position }} {{ $contentClasses }}"
            style="display: none;"
            @click="close()">
        <div>
            {{ $content }}
        </div>
    </div>
</div>