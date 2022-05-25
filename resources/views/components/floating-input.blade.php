@props([
    'id'      => '',
    'type'    => 'text',
    'name'    => '',
    'content' => ''
])

<div class="relative z-0 w-full mb-5">
    <input
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder=" "
        {!! $attributes->merge(['class' => 'pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200']) !!}
    />
    <label
        for="{{ $id }}"
        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
    >
        {{ $content }}
    </label>
</div>