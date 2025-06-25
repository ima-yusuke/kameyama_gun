<x-app-layout>
    <section class="min-w-full h-full flex items-start justify-center p-10">
        <table class="table-fixed w-full max-w-[95%]">
            <colgroup>
                <!-- 1列目：ID は固定 3rem -->
                <col class="w-12">
                <!-- 2列目：品名はテーブル幅の40% -->
                <col class="w-[40%]">
                <!-- 3列目：カテゴリーは自動 -->
                <col>
                <!-- 4列目：在庫は固定 5rem -->
                <col class="w-20">
                <!-- 4列目：在庫は固定 5rem -->
                <col class="w-20">
                <!-- 4列目：在庫は固定 5rem -->
                <col class="w-20">
            </colgroup>
            <thead>
            <tr>
                <th class="border border-gray-500 px-4 py-2">/</th>
                <th class="border border-gray-500 px-4 py-2">品名（メーカー）</th>
                <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">カテゴリー</th>
                <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">在庫</th>
                <th class="border border-gray-500 px-4 py-2 ">編集</th>
                <th class="border border-gray-500 px-4 py-2 ">削除</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                @if($item->category["role"]!=1)
                    @continue;
                @endif
                <tr>
                    <td class="border border-gray-500 px-4 py-2">
                        <div class="flex justify-center items-center">
                        {{ $item["id"] }}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-2">{{ $item["name"] }}</td>
                    <td class="border border-gray-500 px-4 py-2">
                        <div class="flex justify-center items-center">
                            {{$item->category["name"]}}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-2 {{$item['is_stock'] === 1 ? 'text-green-700':'text-red-500'}}">
                        <div class="flex justify-center items-center">
                            {{ $item["is_stock"]===1?"有":"無"}}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-2">
                        <div class="flex justify-center items-center">
                            <button data-bullet="{{json_encode($item)}}" data-category="{{json_encode($item->category)}}" onclick="OpenBulletEditModal(event)" class="bg-blue-500 text-white px-4 py-1 rounded-lg whitespace-nowrap">編集</button>
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-2">
                        <div class="flex justify-center items-center">
                            <a onclick="return confirm('本当に削除しますか？');" href="{{ route('admin.bullet.delete', $item['id']) }}" class="bg-red-500 text-white px-4 py-1 rounded-lg whitespace-nowrap">削除</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <!--modal -->
    <div id="bullet_edit_modal" class="hidden fixed top-1/2 transform -translate-y-1/2 inset-0 z-50 flex justify-center items-center w-full h-[80%] overflow-y-scroll">
        <div class="relative p-4 w-[90%] h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 w-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    {{--品名--}}
                    <h3 id="bullet_modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    {{--閉じるボタン--}}
                    <button type="button" id="bullet_edit_close_btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 w-full">
                    <form enctype="multipart/form-data" method="post" action="{{route("admin.bullet.update")}}"  class="w-[100%] flex flex-col gap-2">
                        @csrf
                        {{--品名--}}
                        <x-dash-form-component :flag="true" title="品名">
                            <input type="text" id="bullet_modal_item_name" required placeholder="例）XYZ弾" name="name" class="rounded-lg">
                        </x-dash-form-component>
                        {{--カテゴリー--}}
                        <x-dash-form-component :flag="true" title="カテゴリー">
                            <select name="category_id" required class="rounded-lg" id="parent_select">
                                @if(is_array($categories) && count($categoies)<1)
                                    <option value="">カテゴリーを登録してください</option>
                                @endif
                            </select>
                        </x-dash-form-component>
                        {{--在庫--}}
                        <x-dash-form-component :flag="true" title="在庫">
                            <div class="flex items-center gap-4">
                                <input type="radio" required name="is_stock" value="1" class="rounded-lg"> 有
                                <input type="radio" required name="is_stock" value="0" class="rounded-lg"> 無（売約済）
                            </div>
                        </x-dash-form-component>
                        {{--料金--}}
                        <x-dash-form-component :flag="false" title="料金">
                            <input type="text" id="bullet_modal_price"  placeholder="例）3000" name="price" class="rounded-lg">
                        </x-dash-form-component>
                        {{--備考欄--}}
                        <x-dash-form-component :flag="false" title="備考欄">
                            <input type="text" id="bullet_modal_note" placeholder="例）25個 /5,000円、50個 /9,000円、100個 /15,000円" name="note" class="rounded-lg">
                        </x-dash-form-component>
                        {{--ID--}}
                        <input type="hidden" name="id" id="bullet_modal_id">
                        {{--登録ボタン--}}
                        <div class="w-full flex justify-center pt-4">
                            <button type="submit" class="w-24 py-4 bg-blue-500 text-white rounded-lg">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="bullet_modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>

    <script>
        const bulletModal = document.getElementById('bullet_edit_modal');//モダル要素
        const closeBulletModalButton = document.getElementById('bullet_edit_close_btn');//モーダルクローズボタン
        const bulletModalBackdrop = document.getElementById('bullet_modal_backdrop');//モダルオープン時のグレー背景

        // モーダルを閉じる
        closeBulletModalButton.addEventListener('click', () => {
            bulletModal.classList.add('hidden');  // モーダルを非表示
            bulletModalBackdrop.classList.add('hidden');  // バックドロップを非表示
        });

        function OpenBulletEditModal(e){
            // モダルを開く
            bulletModal.classList.remove('hidden');  // モーダルを表示
            bulletModal.setAttribute('aria-hidden', 'false');
            bulletModalBackdrop.classList.remove('hidden');  // バックドロップを表示

            let data = JSON.parse(e.currentTarget.getAttribute("data-bullet"));//itemsテーブル
            let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

            // 品名TOP
            const modalTitle = document.getElementById('bullet_modal_title');
            modalTitle.textContent = `品名：${data.name} `
            // 品名input
            const modalItemName = document.getElementById('bullet_modal_item_name');
            modalItemName.value = data.name;

            // カテゴリーセレクトボックスの要素を取得
            let parentSelect = document.getElementById('parent_select');
            // カテゴリーリストを取得
            let categories = {!! json_encode($categories) !!};
            // カテゴリーリストが存在する場合、optionのグループを作成
            if(categories!=null || 0< categories.length){

                // すべてのoptionを一旦クリア
                parentSelect.innerHTML = `<option value="">選択してください</option>`;
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
            }

            // 実行部分
            categories.forEach(category => {
                // ルートカテゴリー（role一致、parent_idがnull）
                if (category.role === 1 && category.parent_id == null) {
                    const newOptGroup = document.createElement('optgroup');
                    newOptGroup.label = category.name;

                    // 自分自身と子孫を再帰的に追加
                    addCategoryOptionsToOptGroup(category, newOptGroup);

                    parentSelect.appendChild(newOptGroup);
                }
            });

            // カテゴリー
            const categorySelect = document.querySelector('select[name="category_id"]'); // select要素を取得
            if (categorySelect) {
                for (let option of categorySelect.options) {
                    if (option.value == category.id) { // 取得したカテゴリーIDと一致するoptionを探す
                        option.selected = true; // 該当するoptionを選択
                    } else {
                        option.selected = false; // それ以外のoptionは非選択
                    }
                }
            }
            // 在庫
            const isStockRadio = document.querySelectorAll('input[name="is_stock"]'); // radio要素を取得
            if (isStockRadio) {
                for (let radio of isStockRadio) {
                    if (radio.value == data.is_stock) { // 取得した在庫情報と一致するradioを探す
                        radio.checked = true; // 該当するradioを選択
                    } else {
                        radio.checked = false; // それ以外のradioは非選択
                    }
                }
            }
            // 料金
            const modalPrice = document.getElementById('bullet_modal_price');
            modalPrice.value = Number(data.price).toLocaleString('en-US');
            // 備考欄
            const modalNote = document.getElementById('bullet_modal_note');
            modalNote.value = data.note;
            // ID
            const modalId = document.getElementById('bullet_modal_id');
            modalId.value = data.id;
        }
    </script>
</x-app-layout>
