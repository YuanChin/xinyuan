<div class="text-zinc-50">
    @foreach($categories as $category)
        <a href="{{ $category->showLink() }}">
            <div
                class="
                    block hover:bg-zinc-900 hover:opacity-80
                    {{ checkRouteParam('postCategory', $category->id) ? 'bg-zinc-700 opacity-80' : '' }}
                ">
                <div class="flex items-center h-14 pl-5 pr-3">
                    <div class="block rounded-full overflow-hidden">
                        <img
                            src="https://megapx-assets.dcard.tw/images/{{ $category->icon }}"
                            alt="{{ $category->name }}"
                            class="w-[30px] h-[30px]"
                        >
                    </div>
                    <div class="ml-2 mr-[10px] overflow-hidden">
                        {{ $category->name }}
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>