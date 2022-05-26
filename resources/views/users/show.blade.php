<x-app-layout>
    <div
        x-data
        class="flex flex-col md:flex-row m-4"
    >
        <div
            x-data="{
                tab: '',
                active: 'text-indigo-400',
            }"
            class="flex flex-col md:basis-2/12 py-2 mb-2 rounded-2xl bg-white shadow-lg"
        >
            <div
                class="flex flex-col mt-4"
            >
                <div class="text-gray-500 mx-4 border-b pb-2 mb-1 border-gray-200 text-md font-normal">
                    <span>創作</span>
                </div>
                <a
                    @click.prevent="
                        tab = 'information';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'information') ? active : ''"
                >    
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span>基本資料</span>
                </a>
                <a
                    @click.prevent="
                        tab = 'post';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'post') ? active : ''"    
                >
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-chat-left"></i>
                    </div>
                    <span>文章</span>
                </a>
            </div>

            <div
                class="flex flex-col mt-4"
            >
                <div class="text-gray-500 mx-4 border-b pb-2 mb-1 border-gray-200 text-md font-normal">
                    <span>互動</span>
                </div>
                <a
                    @click.prevent="
                        tab = 'comment';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'comment') ? active : ''"
                >
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-chat-left"></i>
                    </div>
                    <span>留言</span>
                </a>
                <a
                    @click.prevent="
                        tab = 'favor';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'favor') ? active : ''"        
                >
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-bookmark-star"></i>
                    </div>
                    <span>收藏</span>
                </a>
            </div>
            <div
                class="flex flex-col mt-4"
            >
                <div class="text-gray-500 mx-4 border-b pb-2 mb-1 border-gray-200 text-md font-normal">
                    <span>關係</span>
                </div>
                <a
                    @click.prevent="
                        tab = 'follow';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'follow') ? active : ''"
                >
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-eye"></i>
                    </div>
                    <span>關注</span>
                </a>
                <a
                    @click.prevent="
                        tab = 'fans';
                        getSelectedView($refs, tab, '{{ route('users.show', $user->id) }}');
                    "
                    class="flex justify-start items-center px-4 py-4 hover:text-indigo-400"
                    :class="(tab === 'fans') ? active : ''"    
                >
                    <div class="w-8 flex justify-start">
                        <i class="bi bi-emoji-heart-eyes"></i>
                    </div>
                    <span>粉絲</span>
                </a>
            </div>
            
        </div>

        <div
            id="content"
            x-ref="content"
            class="basis-7/12 mb-2 mx-4"
        >
            @include('users.parts.information')
        </div>

        <div
            class="md:basis-3/12 shadow-lg rounded-2xl bg-white"
        >    
            <div class="flex flex-col items-center justify-center p-4">
                <div class="flex flex-col">
                    <a href="#" class="block relative">
                        <img alt="{{ $user->name }}" src="{{ $user->avatar }}" class="mx-auto object-cover rounded-full h-20 w-20  border-2 border-white dark:border-gray-800"/>
                    </a>
                    <span class="flex justify-center text-gray-800 text-xl font-medium mt-2">
                        {{ $user->name }}
                    </span>
                </div>
                <div class="flex flex-col mt-4 w-full">
                    <div class="text-gray-500 border-b-2 pb-2 border-gray-200 mb-2 text-md font-normal">
                        <span>個人簡介</span>
                    </div>
                    <div class="text-left text-sm">
                        <span>{{ $user->introduction }}</span>
                    </div>
                </div>
                <div class="flex flex-col mt-4 w-full">
                    <div class="text-gray-500 border-b-2 pb-2 border-gray-200 mb-2 text-md font-normal">
                        <span>註冊於</span>
                    </div>
                    <div class="text-left text-sm">
                        <span>{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="flex flex-col mt-4 w-full">
                    <div class="text-gray-500 border-b-2 pb-2 border-gray-200 mb-2 text-md font-normal">
                        <span>最後登入於</span>
                    </div>
                </div>    
                <div class="p-2 w-full mt-4">
                    <div class="flex items-center justify-between text-sm text-gray-600 text-center">
                        <div class="flex flex-col">
                            <span>文章</span>
                            <span class="text-black font-bold">34</span>
                        </div>
                        <div class="flex flex-col">
                            <span>追蹤者</span>
                            <span class="text-black font-bold">455</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section('scripts')
<script>
    function getSelectedView($refs, tab, url)
    {
        axios.get(url+'/?tab='+tab)
            .then(function (response) {
                $refs.content.innerHTML = response.data;
                history.replaceState({}, '', url+'/?tab='+tab)
                sessionStorage.setItem("content", response.data)
            })
    }
    (function () {
        function getQueryVariable(variable)
        {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
        let contentDOM = document.getElementById('content');
        let contentData = sessionStorage.getItem("content");
        console.log(contentData);
        if (getQueryVariable('tab')) {
            contentDOM.innerHTML = contentData;
        }
    })();
</script>
@stop
</x-app-layout>

