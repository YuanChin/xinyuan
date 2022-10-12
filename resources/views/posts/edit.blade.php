<x-app-layout>
    <div class="w-full min-h-screen">
        <form 
            id="post_form"
            method="POST"
            class="flex flex-col pt-5 px-24"
        >
            @csrf
            {{ method_field('PUT') }}
            <x-shared.error></x-shared.error>
            <input 
                type="text"
                name="title"
                value="{{ $data['title'] ?? $post->title }}"
                class="bg-zinc-900 border-0 focus:ring-0 text-5xl text-white p-0"
                placeholder="請輸入您的標題 ...."
            >
            <div class="flex items-center my-5">
                <select class="bg-zinc-900 border-0 focus:ring-0 text-lg text-white w-[200px] pl-1" name="post_category_id" required>
                    <option value="" hidden disabled 
                        {{ $post->post_category_id ? '' : 'selected' }}
                    >請選擇分類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ ($data['post_category_id'] ?? $post->post_category_id) == $category->id ? 'selected' : '' }}
                    >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="editor—wrapper">
                <div id="toolbar-container"></div>
                <div id="editor-container"></div>
            </div>
            <textarea id="wang-editor" name="body" style="display: none"></textarea>
            <div class="fixed inset-x-0 bottom-0 h-[60px] bg-zinc-50">
                <div class="flex items-center gap-3 h-full mx-5">
                    <input
                        type="submit"
                        value="發布文章"
                        formaction="{{ route('posts.publish', $post->id) }}"
                        class="cursor-pointer px-4 py-2 border-transparent bg-red-500 text-zinc-50 hover:opacity-70 transition-all duration-300 rounded-xl"
                    >
                    <input
                        type="submit"
                        value="儲存草稿"
                        formaction="{{ route('posts.unpublish', $post->id) }}"
                        class="cursor-pointer px-4 py-2 border border-zinc-500 hover:bg-zinc-300 transition-all duration-300 rounded-xl"
                    >
                </div>
            </div>
        </form>
    </div>


@section('css')

{{-- wanggEditor css --}}
<link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">
<style>
    #editor-container { 
        height: 100vh;
        padding-bottom: 80px;
    }
</style>

@endsection

@section('script')

{{-- wanggEditor js --}}
<script src="https://unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>
<script>
    let wang_editor = document.getElementById('wang-editor');
    let postForm = document.getElementById("post_form");
    let oldImages = [];
    let newImages = [];
    let count = 0;

    const { createEditor, createToolbar } = window.wangEditor;

    const editorConfig = {
        MENU_CONF: {},
        placeholder: '請輸入內容 ...',
        onChange(editor) {
            wang_editor.value = editor.getHtml();

            if (count === 0) {
                oldImages = editor.getElemsByType('image');
                count = null;
            }

            newImages = editor.getElemsByType('image');

            if (oldImages.length > newImages.length) {
                for (let index in oldImages) {
                    if(! isInArray(newImages , oldImages[index])) {
                        let regexp = new RegExp('(?<=images/).*');
                        let imagePath = oldImages[index].src.match(regexp);
                        deleteImage(imagePath[0]);
                    }
                }
            }
        }
    };

    editorConfig.MENU_CONF['uploadImage'] = {
        async customUpload(file, insertFn) {
            let fd = new FormData();
            fd.append('upload_file', file);
            let response = await (await fetch('{{ route("posts.upload_image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: fd
            })).json();

            if (response.status === 0) {
                insertFn(response.data.url, response.data.alt, response.data.href);
                Toast.fire({
                    icon: 'success',
                    title: response.message,
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.message,
                });
            }
        }
    };

    editorConfig.MENU_CONF['insertImage'] = {
        onInsertedImage(imageNode) {
            if (imageNode == null) {
                return;
            }

            oldImages.push(imageNode);
        },
    };

    const editor = createEditor({
        selector: '#editor-container',
        html: `{!! $data['body'] ?? $post->body !!}`,
        config: editorConfig,
        mode: 'default',
    });

    const toolbarConfig = {};

    const toolbar = createToolbar({
        editor,
        selector: '#toolbar-container',
        config: toolbarConfig,
        mode: 'default',
    });

    function isInArray(newImages, oldImage)
    {
        for (let i = 0; i < newImages.length; i++) {
            if (oldImage.src === newImages[i].src) {
                return true;
            }

            return false;
        }
    }

    async function deleteImage(path)
    {
        await fetch("{{ route('posts.delete_image') }}", {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({imagePath: path})
        });
    }

    postForm.onclick = function () {
        const formData = {
            title: postForm.elements.title.value,
            post_category_id: postForm.elements.post_category_id.value,
            body: postForm.elements.body.value,
            post_id: `{{ $post->id }}`
        };

        if (formData.title !== '' && formData.body !== '<p><br></p>') {
            fetch(`{{ route('posts.updated') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-type': 'application/json; charset=UTF-8',
                },
                body: JSON.stringify(formData)
            });
        }
    };
</script>
@endsection
</x-app-layout>