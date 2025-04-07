<x-app-layout>
    <section class="w-full h-full flex items-center justify-center py-10">
        <table>
            <thead>
            <tr>
                <th class="border border-gray-500 px-4 py-2">/</th>
                <th class="border border-gray-500 px-4 py-2">品名（メーカー）</th>
                <th class="border border-gray-500 px-4 py-2">カテゴリー</th>
                <th class="border border-gray-500 px-4 py-2">口径</th>
                <th class="border border-gray-500 px-4 py-2">料金</th>
                <th class="border border-gray-500 px-4 py-2">ステータス</th>
                <th class="border border-gray-500 px-4 py-2">備考欄</th>
                <th class="border border-gray-500 px-4 py-2">編集</th>
                <th class="border border-gray-500 px-4 py-2">削除</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                @if($item->category["role"]!=0)
                    @continue;
                @endif
                <tr>
                    <td class="border border-gray-500 px-4 py-2">{{ $item["id"] }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $item["name"] }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{$item->category["name"]}}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $item->gunDetail["diameter"] }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $item['price']==null?"未設定": "￥" .number_format($item['price'])}}</td>
                    <td class="border border-gray-500 px-4 py-2 {{$item['is_stock'] === 1 ? '':'text-red-500'}}">
                        {{ $item["is_stock"]===1?"在庫有":"売約済"}}
                    </td>
                    <td class="border border-gray-500 px-4 py-2">{{ $item["note"] }}</td>
                    <td class="border border-gray-500 px-4 py-2">
                        <button data-gun="{{json_encode($item)}}" data-gun-detail="{{json_encode($item->gunDetail)}}" data-category="{{json_encode($item->category)}}" onclick="OpenGunEditModal(event)" class="bg-blue-500 text-white px-4 py-1 rounded-lg">編集</button>
                    </td>
                    <td class="border border-gray-500 px-4 py-2">
                        <a onclick="return confirm('本当に削除しますか？');" href="{{ route('admin.gun.delete', $item['id']) }}" class="bg-red-500 text-white px-4 py-1 rounded-lg">削除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <!--modal -->
    <div id="gun_edit_modal" class="hidden fixed top-1/2 transform -translate-y-1/2 inset-0 z-50 flex justify-center items-center w-full h-[70%] overflow-y-scroll">
        <div class="relative p-4 w-[80%] h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 w-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    {{--品名--}}
                    <h3 id="gun_modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    {{--閉じるボタン--}}
                    <button type="button" id="gun_edit_close_btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 w-full">
                    <form enctype="multipart/form-data" method="post" action="{{route("admin.gun.update")}}"  class="w-[90%] flex flex-col gap-2">
                        @csrf
                        {{--品名--}}
                        <x-dash-form-component :flag="true" title="品名">
                            <input type="text" id="gun_modal_item_name" required placeholder="例）ABC銃" name="name" class="rounded-lg">
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
                                <input type="radio" required name="is_stock" value="1" class="rounded-lg"> 有り
                                <input type="radio" required name="is_stock" value="0" class="rounded-lg"> 無し（売約済）
                            </div>
                        </x-dash-form-component>
                        {{--全長--}}
                        <x-dash-form-component :flag="true" title="全長">
                            <input type="number" id="gun_modal_full_length" step="any" required placeholder="例）125.6" name="full_length" class="rounded-lg">
                        </x-dash-form-component>
                        {{--総重量--}}
                        <x-dash-form-component :flag="true" title="総重量">
                            <input type="number" id="gun_modal_full_weight" step="any" required placeholder="例）125.6" name="full_weight" class="rounded-lg">
                        </x-dash-form-component>
                        {{--口径--}}
                        <x-dash-form-component :flag="true" title="口径">
                            <input type="number" id="gun_modal_diameter" step="any" required placeholder="例）40" name="diameter" class="rounded-lg">
                        </x-dash-form-component>
                        {{--メーカー--}}
                        <x-dash-form-component :flag="false" title="メーカー">
                            <input type="text" id="gun_modal_brand" placeholder="例）SIG SAUER" name="brand" class="rounded-lg">
                        </x-dash-form-component>
                        {{--商品モデル--}}
                        <x-dash-form-component :flag="false" title="商品モデル">
                            <input type="text" id="gun_modal_model" placeholder="例）R93" name="model" class="rounded-lg">
                        </x-dash-form-component>
                        {{--生産国--}}
                        <x-dash-form-component :flag="false" title="生産国">
                            <input type="text" id="gun_modal_country" placeholder="例）日本" name="country" class="rounded-lg">
                        </x-dash-form-component>
                        {{--料金--}}
                        <x-dash-form-component :flag="false" title="料金">
                            <input type="number" id="gun_modal_price"  placeholder="例）3000" name="price" class="rounded-lg">
                        </x-dash-form-component>
                        {{--画像--}}
                        <x-dash-form-component :flag="false" title="画像">
                            <aside class="flex gap-8">
                                <div class="flex flex-col items-center gap-1 border-r border-dashed border-gray-500 px-8">
                                    <p>現在の画像</p>
                                    <p id="gun_image_not_exist" class="hidden">画像が登録されていません</p>
                                    <img data-base-url="{{ asset('storage/img/') }}" src="" id="gun_modal_img" class="w-[200px] h-[150px] object-cover">
                                </div>
                                <div class="flex flex-col items-center gap-1">
                                    <p>新しい画像</p>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="rounded-lg">
                                </div>
                            </aside>
                        </x-dash-form-component>
                        {{--備考欄--}}
                        <x-dash-form-component :flag="false" title="備考欄">
                            <input type="text" id="gun_modal_note" placeholder="例）25個 /5,000円、50個 /9,000円、100個 /15,000円" name="note" class="rounded-lg">
                        </x-dash-form-component>
                        <input type="hidden" name="id" id="gun_modal_id">
                        {{--登録ボタン--}}
                        <div class="w-full flex justify-center pt-4">
                            <button type="submit" class="w-24 py-4 bg-blue-500 text-white rounded-lg">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="gun_modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>

    <script>
        const gunModal = document.getElementById('gun_edit_modal');//モダル要素
        const closeGunModalButton = document.getElementById('gun_edit_close_btn');//モーダルクローズボタン
        const gunModalBackdrop = document.getElementById('gun_modal_backdrop');//モダルオープン時のグレー背景

        // モーダルを閉じる
        closeGunModalButton.addEventListener('click', () => {
            gunModal.classList.add('hidden');  // モーダルを非表示
            gunModalBackdrop.classList.add('hidden');  // バックドロップを非表示
        });

        function OpenGunEditModal(e){
            // モダルを開く
            gunModal.classList.remove('hidden');  // モーダルを表示
            gunModal.setAttribute('aria-hidden', 'false');
            gunModalBackdrop.classList.remove('hidden');  // バックドロップを表示

            let data = JSON.parse(e.currentTarget.getAttribute("data-gun"));//itemsテーブル
            let gunDetail = JSON.parse(e.currentTarget.getAttribute("data-gun-detail"));//gun_detailsテーブル
            let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

            // 品名TOP
            const modalTitle = document.getElementById('gun_modal_title');
            if (gunDetail.model == null) {
                modalTitle.textContent = `品名：${data.name} / モデル：未設定`;
            } else {
                modalTitle.textContent = `品名：${data.name} / モデル：${gunDetail.model}`;
            }
            // 品名input
            const modalItemName = document.getElementById('gun_modal_item_name');
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
                if (category.role === 0 && category.parent_id == null) {
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
            // メーカー
            const modalBrand = document.getElementById('gun_modal_brand');
            modalBrand.value = gunDetail.brand;
            // 商品モデル
            const modalModel = document.getElementById('gun_modal_model');
            modalModel.value = gunDetail.model;
            // 生産国
            const modalCountry = document.getElementById('gun_modal_country');
            modalCountry.value = gunDetail.country;
            // 全長
            const modalFullLength = document.getElementById('gun_modal_full_length');
            modalFullLength.value = gunDetail.full_length;
            // 総重量
            const modalFullWeight = document.getElementById('gun_modal_full_weight');
            modalFullWeight.value = gunDetail.full_weight;
            // 口径
            const modalDiameter = document.getElementById('gun_modal_diameter');
            modalDiameter.value = gunDetail.diameter;
            // 料金
            const modalPrice = document.getElementById('gun_modal_price');
            modalPrice.value = data.price;
            // 画像
            const modalImage = document.getElementById('gun_modal_img');
            const baseUrl = modalImage.getAttribute("data-base-url");//asset関数後のベースURL
            if (gunDetail.image == null) {
                modalImage.classList.add('hidden');
                document.getElementById('gun_image_not_exist').classList.remove('hidden');
            } else {
                document.getElementById('gun_image_not_exist').classList.add('hidden');
                modalImage.classList.remove('hidden');
                modalImage.src = `${baseUrl}/${data.id}/${gunDetail.image}`;
            }
            // 備考欄
            const modalNote = document.getElementById('gun_modal_note');
            modalNote.value = data.note;
            // ID
            const modalId = document.getElementById('gun_modal_id');
            modalId.value = data.id;
        }
    </script>
</x-app-layout>
