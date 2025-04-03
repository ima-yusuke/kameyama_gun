<h1 id="current_category" class="w-full"></h1>

{{--フィルターボタン--}}
<article class="w-full flex justify-center gap-6 py-8">
    @foreach($categories as $category)
        @if($category["parent_id"]!==null)
            <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" class="child-category hidden bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="Filter(event)">
                {{$category->name}}
            </button>
        @else
            <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" class="parent-category bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="Filter(event)">
                {{$category->name}}
            </button>
        @endif
    @endforeach
        <button id="back_btn" class="hidden bg-red-500 text-white px-4 py-2 rounded-lg">
            戻る
        </button>
</article>

{{--一覧--}}
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
        </tr>
    </thead>
    <tbody>
        @foreach ($dataArray as $data)
            {{--銃でない（roleが0でない）場合はスキップ--}}
            @if($data->category["role"]!==0)
                @continue
            @endif
            <tr data-gun="{{json_encode($data)}}" data-gun-detail="{{json_encode($data->gunDetail)}}" data-category="{{json_encode($data->category)}}" onclick="OpenModal(event)">
                <td class="border border-gray-500 px-4 py-2">{{ $data["id"] }}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $data["name"] }}</td>
                <td class="border border-gray-500 px-4 py-2">{{$data->category["name"]}}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $data->gunDetail["diameter"] }}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $data['price']==null?"未設定": "￥" .number_format($data['price'])}}</td>
                <td class="border border-gray-500 px-4 py-2 {{$data['is_stock'] === 1 ? '':'text-red-500'}}">
                    {{ $data["is_stock"]===1?"在庫有":"売約済"}}
                </td>
                <td class="border border-gray-500 px-4 py-2">{{ $data["note"] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!--modal -->
<div id="static-modal" class="hidden fixed inset-0 z-50 flex justify-center items-center min-h-screen">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                {{--品名--}}
                <h3 id="modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                {{--閉じるボタン--}}
                <button type="button" id="modal-close-btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                {{--画像--}}
                <div id="image_container">
                    <p id="image_not_exist" class="hidden">画像が登録されていません</p>
                    <img data-base-url="{{ asset('storage/img/') }}" id="modal_image" src="{{asset("storage/img/logo_1.jpg")}}" alt="gun" class="object-cover w-[100%] h-[300px]">
                </div>
                <aside class="flex flex-wrap gap-4 w-full">
                    {{--カテゴリー--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">カテゴリー</p>
                        <p id="modal_category"></p>
                    </div>
                    {{--生産国--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">生産国</p>
                        <p id="modal_country"></p>
                    </div>
                    {{--価格--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">料金</p>
                        <p id="modal_price"></p>
                    </div>
                    {{--ブランド--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">ブランド</p>
                        <p id="modal_brand"></p>
                    </div>
                </aside>
                <p class="w-full border-b border-dashed border-gray-500"></p>
                <aside class="flex flex-wrap gap-4 w-full">
                    {{--全長--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">全長</p>
                        <p id="modal_full_length"></p>
                    </div>
                    {{--総重量--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">総重量</p>
                        <p id="modal_full_weight"></p>
                    </div>
                    {{--口径--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">口径</p>
                        <p id="modal_diameter"></p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<div id="modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>

<script>
    const modal = document.getElementById('static-modal');//モダル要素
    const closeModalButton = document.getElementById('modal-close-btn');//モーダルクローズボタン
    const modalBackdrop = document.getElementById('modal_backdrop');//モダルオープン時のグレー背景

    // モーダルを閉じる
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');  // モーダルを非表示
        modalBackdrop.classList.add('hidden');  // バックドロップを非表示
    });

    // trをクリック時に発火
    function OpenModal(e) {
        // モダルを開く
        modal.classList.remove('hidden');  // モーダルを表示
        modal.setAttribute('aria-hidden', 'false');
        modalBackdrop.classList.remove('hidden');  // バックドロップを表示

        // e.currentTargetで<tr>要素を取得
        let data = JSON.parse(e.currentTarget.getAttribute("data-gun"));//itemsテーブル
        let gunDetail = JSON.parse(e.currentTarget.getAttribute("data-gun-detail"));//gun_detailsテーブル
        let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

        // 品名とモデル
        const modalTitle = document.getElementById('modal_title');
        if (gunDetail.model == null) {
            modalTitle.textContent = `品名：${data.name} / モデル：未設定`;
        } else {
            modalTitle.textContent = `品名：${data.name} / モデル：${gunDetail.model}`;
        }
        //画像
        const modalImage = document.getElementById('modal_image');
        const baseUrl = modalImage.getAttribute("data-base-url");//asset関数後のベースURL
        if (gunDetail.image == null) {
            modalImage.classList.add('hidden');
            document.getElementById('image_not_exist').classList.remove('hidden');
        } else {
            document.getElementById('image_not_exist').classList.add('hidden');
            modalImage.classList.remove('hidden');
            modalImage.src = `${baseUrl}/${data.id}/${gunDetail.image}`;
        }
        // カテゴリー
        const modalCategory = document.getElementById('modal_category');
        modalCategory.textContent = category.name;
        // 生産国
        const modalCountry = document.getElementById('modal_country');
        if(gunDetail.country == null){
            modalCountry.textContent = '未設定';
        } else {
            modalCountry.textContent = gunDetail.country;
        }
        // 料金
        const modalPrice = document.getElementById('modal_price');
        if (data.price == null) {
            modalPrice.textContent = '未設定';
        } else{
            modalPrice.textContent = `￥${data.price.toLocaleString()}`;
        }
        // ブランド
        const modalBrand = document.getElementById('modal_brand');
        if(gunDetail.brand == null){
            modalBrand.textContent = '未設定';
        } else {
            modalBrand.textContent = gunDetail.brand;
        }
        // 全長
        const modalFullLength = document.getElementById('modal_full_length');
        modalFullLength.textContent = gunDetail.full_length;
        // 総重量
        const modalFullWeight = document.getElementById('modal_full_weight');
        modalFullWeight.textContent = gunDetail.full_weight;
        // 口径
        const modalDiameter = document.getElementById('modal_diameter');
        modalDiameter.textContent = gunDetail.diameter;
    }

    // 戻るボタンをクリックした時の処理のためクリックしたカテゴリーボタンのidを保持する配列
    let parentIdArray =[];
    // ルートカテゴリーのボタン
    let parentCategoryBtns = document.querySelectorAll(".parent-category");
    // ルート以外のカテゴリーのボタン
    let childCategoryBtns = document.querySelectorAll(".child-category");

    // フィルターボタン
    let allData = @json($dataArray);

    function Filter(event) {
        let categoryId = event.currentTarget.getAttribute("data-id");

        // すべてのテーブル行を一度クリア
        let tableBody = document.querySelector("tbody");
        tableBody.innerHTML = "";

        let filteredData = [];

        // 選択されたカテゴリーのデータを取得（再帰的に処理）
        function getFilteredData(categoryId, dataList) {
            dataList.forEach(data => {
                if (data.category_id == categoryId) {
                    filteredData.push(data);

                    // 子カテゴリーがある場合、再帰的に処理
                    if (data.category.children && data.category.children.length > 0) {
                        data.category.children.forEach(childCategory => {
                            getFilteredData(childCategory.id, dataList);
                        });
                    }
                }
            });
        }

        // 実行（選択された categoryId からすべての関連データを取得）
        getFilteredData(categoryId, allData);

        // フィルタリング結果をテーブルに追加
        filteredData.forEach(data => {
            appendRow(tableBody, data);
        });

        //新しいカテゴリーフィルターを表示
        ToggleCategorySort(event);

        parentIdArray.push(categoryId);

        // 戻るボタンを表示
        document.getElementById("back_btn").classList.remove("hidden");

        // 戻るボタンをクリックした時の処理
        document.getElementById("back_btn").onclick = function() {
            // 一つ前のカテゴリーのデータを取得
            parentIdArray.pop();

            // すべてのテーブル行を一度クリア
            let tableBody = document.querySelector("tbody");
            tableBody.innerHTML = "";

            let filteredData = [];

            // 選択されたカテゴリーのデータを取得（再帰的に処理）
            function getFilteredData(categoryId, dataList) {
                dataList.forEach(data => {
                    if (data.category_id == categoryId) {
                        filteredData.push(data);

                        // 子カテゴリーがある場合、再帰的に処理
                        if (data.category.children && data.category.children.length > 0) {
                            data.category.children.forEach(childCategory => {
                                getFilteredData(childCategory.id, dataList);
                            });
                        }
                    }
                });
            }

            // テーブルに1つ前のカテゴリーのデータを追加
            if( parentIdArray.length === 0){
                allData.forEach(data => {
                    if(data.category["role"]===0){
                        appendRow(tableBody, data);
                    }
                });
                parentCategoryBtns.forEach(category => {
                    category.classList.remove("hidden");
                });

                childCategoryBtns.forEach(category => {
                    category.classList.add("hidden");
                });

                // 戻るボタンを非表示
                document.getElementById("back_btn").classList.add("hidden");
            }else{
                getFilteredData(parentIdArray[parentIdArray.length - 1], allData);
                // フィルタリング結果をテーブルに追加
                filteredData.forEach(data => {
                    appendRow(tableBody, data);
                });

                // 1つ前のカテゴリーのボタンを表示
                showChildren(parentIdArray[parentIdArray.length - 1]);
            }

            let currentCategory = document.getElementById("current_category").innerText;

            if (parentIdArray.length !== 0) {
                // 最後の " -> " 以降を削除
                document.getElementById("current_category").innerText = currentCategory.substring(0, currentCategory.lastIndexOf(" -> "));
            } else {
                // それ以上戻れない場合は空にする
                document.getElementById("current_category").innerText = "";
            }

            return;
        };

        // 現在の位置を表示するh1要素のテキストを更新
        if(document.getElementById("current_category").innerText===""){

            document.getElementById("current_category").innerHTML =  event.currentTarget.innerText;
        }else{
            document.getElementById("current_category").innerHTML += " -> " + event.currentTarget.innerText;
        }
    }

    //データをテーブルに追加
    function appendRow(tableBody, data) {
        let row = document.createElement("tr");

        row.setAttribute("data-gun", JSON.stringify(data));
        row.setAttribute("data-gun-detail", JSON.stringify(data.gun_detail));
        row.setAttribute("data-category", JSON.stringify(data.category));

        row.onclick = function(event) {
            OpenModal(event);
        };

        row.innerHTML = `
            <td class="border border-gray-500 px-4 py-2">${data.id}</td>
            <td class="border border-gray-500 px-4 py-2">${data.name}</td>
            <td class="border border-gray-500 px-4 py-2">${data.category.name}</td>
            <td class="border border-gray-500 px-4 py-2">${data.gun_detail.diameter}</td>
            <td class="border border-gray-500 px-4 py-2">${data.price == null ? "未設定" : "￥" + new Intl.NumberFormat().format(data.price)}</td>
            <td class="border border-gray-500 px-4 py-2 ${data.is_stock === 1 ? '' : 'text-red-500'}">
                ${data.is_stock === 1 ? "在庫有" : "売約済"}
            </td>
            <td class="border border-gray-500 px-4 py-2">${data.note}</td>
        `;

        tableBody.appendChild(row);
    }

    // クリックしたボタンのカテゴリーidを保持する変数
    let clickedCategoryId = null;

    // 子カテゴリーを再帰的に表示する関数
    function showChildren(parentId) {
        childCategoryBtns.forEach(category => {
            if (category.getAttribute("data-parent-id") === parentId) {
                category.classList.remove("hidden");
                // 再帰的にそのカテゴリーの子カテゴリーも表示する
                showChildren(category.getAttribute("data-id"));
            }
        });
    }

    // 親カテゴリーを非表示にする関数
    function hideParent() {

        parentCategoryBtns.forEach(category => {
            category.classList.add("hidden");
        });

        childCategoryBtns.forEach(category => {
            category.classList.add("hidden");
        });
    }

    function ToggleCategorySort(e) {

        // クリックしたボタンのカテゴリーid
        clickedCategoryId = e.currentTarget.getAttribute("data-id");

        // クリックしたカテゴリーの親を非表示
        hideParent();

        // クリックしたカテゴリーの子を表示
        showChildren(clickedCategoryId);
    }
</script>
