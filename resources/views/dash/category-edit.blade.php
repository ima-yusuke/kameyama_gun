<x-app-layout>
    <section class="w-full h-full flex flex-col items-center py-10">
        {{--tabメニュー--}}
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="category-tab-list" data-tabs-toggle="#category-tab-content" role="tablist">
            @for($i = 0; $i < 3; $i++)
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 px-10 border-b-2 rounded-t-lg @if($i !== 0) hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 @else text-blue-600 border-blue-600 @endif"
                            id="category{{$i}}-tab"
                            data-tabs-target="#category{{$i}}"
                            type="button"
                            role="tab"
                            aria-controls="category{{$i}}"
                            aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                        @if($i==0)
                            <i class="fa-solid fa-gun pr-2"></i>銃
                        @elseif($i==1)
                            <i class="fa-solid fa-circle pr-2"></i>弾
                        @elseif($i==2)
                            <i class="fa-solid fa-briefcase pr-2"></i>その他
                        @endif
                    </button>
                </li>
            @endfor
        </ul>

        {{--tabコンテンツ--}}
        <div id="category-tab-content">
            @for($i = 0; $i < 3; $i++)
                <div class="@if($i !== 0) hidden @endif p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full"
                     id="category{{$i}}"
                     role="tabpanel"
                     aria-labelledby="category{{$i}}-tab">
                    <table>
                        <thead>
                        <tr>
                            <th class="border border-gray-500 px-4 py-2">/</th>
                            <th class="border border-gray-500 px-4 py-2">分類</th>
                            <th class="border border-gray-500 px-4 py-2">カテゴリー</th>
                            <th class="border border-gray-500 px-4 py-2">親カテゴリー</th>
                            <th class="border border-gray-500 px-4 py-2">編集</th>
                            <th class="border border-gray-500 px-4 py-2">削除</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            @if($category->role != $i)
                                @continue
                            @endif
                            <tr>
                                <td class="border border-gray-500 px-4 py-2">{{$category->id}}</td>
                                <td class="border border-gray-500 px-4 py-2">
                                    @if($i==0) 銃
                                    @elseif($i==1) 弾
                                    @elseif($i==2) その他
                                    @endif
                                </td>
                                <td class="border border-gray-500 px-4 py-2">{{$category->name}}</td>
                                <td class="border border-gray-500 px-4 py-2">{{$category->parent["name"]}}</td>
                                <td class="border border-gray-500 px-4 py-2">
                                    <button data-category="{{json_encode($category)}}" onclick="OpenCategoryEditModal(event)" class="bg-blue-500 text-white px-4 py-1 rounded-lg">編集</button>
                                </td>
                                <td class="border border-gray-500 px-4 py-2">
                                    <a onclick="return confirm('本当に削除しますか？このカテゴリーを持つ商品も全て削除されます。');" href="{{ route('admin.category.delete', $category['id']) }}" class="bg-red-500 text-white px-4 py-1 rounded-lg">削除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endfor
        </div>
    </section>

    <!--modal -->
    <div id="category_edit_modal" class="hidden fixed top-1/2 transform -translate-y-1/2 inset-0 z-50 flex justify-center items-center w-full h-[70%] overflow-y-scroll">
        <div class="relative p-4 w-[80%] h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 w-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    {{--現在のカテゴリ名--}}
                    <h3 id="category_modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    {{--閉じるボタン--}}
                    <button type="button" id="category_edit_close_btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 w-full">
                    <form enctype="multipart/form-data" method="post" action="{{route("admin.category.update")}}"  class="w-[90%] flex flex-col gap-2">
                        @csrf
                        {{--カテゴリー名--}}
                        <x-dash-form-component :flag="true" title="カテゴリー名">
                            <input type="text" id="category_modal_name" required placeholder="例）上下二連銃" name="name" class="rounded-lg">
                        </x-dash-form-component>
                        {{--カテゴリー--}}
                        <x-dash-form-component :flag="true" title="親カテゴリー">
                            <select id="parent_select" name="parent_id" required class="rounded-lg">
                            </select>
                        </x-dash-form-component>
                        <input type="hidden" name="id" id="category_modal_id">
                        {{--登録ボタン--}}
                        <div class="w-full flex justify-center pt-4">
                            <button type="submit" class="w-24 py-4 bg-blue-500 text-white rounded-lg">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="category_modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
    <script>
        const categoryModal = document.getElementById('category_edit_modal');//モダル要素
        const closeCategoryModalButton = document.getElementById('category_edit_close_btn');//モーダルクローズボタン
        const categoryModalBackdrop = document.getElementById('category_modal_backdrop');//モダルオープン時のグレー背景

        // モーダルを閉じる
        closeCategoryModalButton.addEventListener('click', () => {
            categoryModal.classList.add('hidden');  // モーダルを非表示
            categoryModalBackdrop.classList.add('hidden');  // バックドロップを非表示
        });

        function OpenCategoryEditModal(e) {
            // モダルを開く
            categoryModal.classList.remove('hidden');  // モーダルを表示
            categoryModal.setAttribute('aria-hidden', 'false');
            categoryModalBackdrop.classList.remove('hidden');  // バックドロップを表示

            // クリックされたボタンからカテゴリーを取得
            let category = JSON.parse(e.currentTarget.getAttribute("data-category"));

            // タイトルに現在のカテゴリー名をセット
            let categoryTitle = document.getElementById('category_modal_title');
            categoryTitle.textContent = category.name;

            //新規カテゴリー名inputのvalueに現在のカテゴリー名をセット
            let categoryNameInput = document.getElementById('category_modal_name');
            categoryNameInput.value = category.name;

            // inputのvalueにidをセット
            let categoryIdInput = document.getElementById('category_modal_id');
            categoryIdInput.value = category.id;

            // 親カテゴリーにroleに合致するデータをoptionにセット
            let selectedRoleValue = category.role;
            let parentSelect = document.getElementById('parent_select');
            // カテゴリーリストを取得
            let categories = {!! json_encode($categories) !!};
            // すべてのoptionを一旦クリア
            parentSelect.innerHTML = `<option value="">選択してください</option><option value="0">ルートカテゴリー</option>`;
            // 選択されたroleに合致するカテゴリを追加
            function addCategoryOptionsToOptGroup(category, optGroup, depth = 0) {
                const indent = '　'.repeat(depth); // 全角スペースでインデント

                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = indent + category.name;
                optGroup.appendChild(option);

                // 子カテゴリーがある場合は再帰的に追加
                if (category.children && category.children.length > 0) {
                    category.children.forEach(child => {
                        addCategoryOptionsToOptGroup(child, optGroup, depth + 1);
                    });
                }
            }

            // 実行部分
            categories.forEach(category => {
                // ルートカテゴリー（role一致、parent_idがnull）
                if (category.role == selectedRoleValue && category.parent_id == null) {
                    const newOptGroup = document.createElement('optgroup');
                    newOptGroup.label = category.name;

                    // 自分自身と子孫を再帰的に追加
                    addCategoryOptionsToOptGroup(category, newOptGroup);

                    parentSelect.appendChild(newOptGroup);
                }
            });

            // 親カテゴリーのselect要素に現在のカテゴリーの親カテゴリーを選択
            const categorySelect = document.querySelector('select[name="parent_id"]'); // select要素を取得
            if (categorySelect) {
                for (let option of categorySelect.options) {
                    if(category.parent['id'] == null) {
                        categorySelect.options[1].selected = true;
                    }
                    if (option.value == category.parent.id) { // 取得したカテゴリーIDと一致するoptionを探す
                        option.selected = true; // 該当するoptionを選択
                    } else {
                        option.selected = false; // それ以外のoptionは非選択
                    }
                }
            }
        }
    </script>
</x-app-layout>
