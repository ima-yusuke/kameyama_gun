<h1 id="current_category" class="w-full font-bold text-xl"></h1>

{{--フィルターボタン--}}
<article class="w-full flex justify-center gap-6 py-8">
    @foreach($categories as $category)
        @if($category["parent_id"]!==null)
            <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" data-category="{{$category}}" data-children="{{$category->children}}" class="child-category hidden bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="Filter(event)">
                {{$category->name}}
            </button>
        @else
            <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" data-category="{{$category}}" data-children="{{$category->children}}" class="parent-category bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="Filter(event)">
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
    <tbody id="default_tbody">
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
                <button onclick="CloseModal()" type="button" id="modal-close-btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
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
    //モダル要素
    const modal = document.getElementById('static-modal');
    //モダルオープン時のグレー背景
    const modalBackdrop = document.getElementById('modal_backdrop');
    //モダルを開く（trをクリック時に発火）
    function OpenModal(e) {

        // モーダルを表示
        modal.classList.remove('hidden');
        // バックドロップを表示
        modalBackdrop.classList.remove('hidden');

        // e.currentTargetで<tr>要素を取得。
        let data = JSON.parse(e.currentTarget.getAttribute("data-gun"));//itemsテーブル
        let gunDetail = JSON.parse(e.currentTarget.getAttribute("data-gun-detail"));//gun_detailsテーブル
        let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

        // 以下、モダルに表示する内容を設定

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
    //モダルを閉じる（ボタンにonclickで指定）
    function CloseModal(){
        modal.classList.add('hidden');  // モーダルを非表示
        modalBackdrop.classList.add('hidden');  // バックドロップを非表示
    }

    //itemsデータ
    let dataArray = @json($dataArray);
    //クリックしたカテゴリーボタンのidを保持する配列（戻るボタンの処理用）
    let parentIdArray =[];
    //tbodyに表示するデータを格納するMap
    let filteredData = new Map();
    // 1つ前のtbodyデータを保存するMap
    let previousTbodyData = new Map();
    //ルートカテゴリーのボタン
    const parentCategoryBtns = document.querySelectorAll(".parent-category");
    //ルート以外のカテゴリーのボタン
    const childCategoryBtns = document.querySelectorAll(".child-category");

    //カテゴリーボタンをクリックした時の処理
    function Filter(event) {

        //クリックしたボタンのカテゴリーid
        let clickedCategoryId = event.currentTarget.getAttribute("data-id");

        //配列に追加（戻るボタンClick時に前回のカテゴリーに戻るため）
        parentIdArray.push(clickedCategoryId);

        //Mapのリセット
        filteredData = new Map();

        //クリックされたカテゴリー
        let clickedCategory = JSON.parse(event.currentTarget.getAttribute("data-category"));
        //Mapにテーブルで使用するデータを格納
        SetFilteredData(clickedCategory);

        //テーブルのデフォルトtbodyを非表示にする
        document.getElementById("default_tbody").classList.add("hidden");

        //もし既に子カテゴリー用のtbodyが存在する場合は削除
        if(document.getElementById("new_tbody") !== null){
            document.getElementById("new_tbody").remove();
        }

        //子カテゴリー用の新しいtbodyを作成
        let newTableBody = document.createElement("tbody");
        // 後でこのtbodyを取得するためidを付与
        newTableBody.id = "new_tbody";
        //newTableBodyに新しいtrを追加
        filteredData.forEach(data => {
            AppendRow(newTableBody, data);
        });

        //全てのカテゴリーを非表示
        HideAllCategoryBtn();

        //クリックしたカテゴリーの子カテゴリーを表示
        ShowChildrenCategory(clickedCategoryId);

        //現在の位置を表示するh1要素のテキストを更新
        if(document.getElementById("current_category").innerText===""){
            document.getElementById("current_category").innerHTML =  event.currentTarget.innerText;
        }else{
            document.getElementById("current_category").innerHTML += " -> " + event.currentTarget.innerText;
        }

        //現在のtbodyデータを保存
        if(document.getElementById("new_tbody") !== null){
            previousTbodyData.set(clickedCategoryId,newTableBody)
        }

        //1つ前のカテゴリーに戻る処理
        BackToPreviousCategory();
    }

    //データをテーブルに追加
    function AppendRow(tableBody, data) {
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
            <td class="border border-gray-500 px-4 py-2">${data.note == null ? "" :data.note}</td>
        `;

        tableBody.appendChild(row);
        document.querySelector("table").appendChild(tableBody);
    }

    //子カテゴリーを表示する関数
    function ShowChildrenCategory(clickedCategoryId) {
        childCategoryBtns.forEach(category => {
            if (category.getAttribute("data-parent-id") === clickedCategoryId) {
                category.classList.remove("hidden");
            }
        });
    }

    //全カテゴリーを非表示にする関数
    function HideAllCategoryBtn() {

        //ルートカテゴリーを非表示
        parentCategoryBtns.forEach(category => {
            category.classList.add("hidden");
        });

        //ルートカテゴリー以外を非表示
        childCategoryBtns.forEach(category => {
            category.classList.add("hidden");
        });
    }

    //クリックされたカテゴリーとその子カテゴリーが持つitemsデータを取得（再帰的に処理）
    function SetFilteredData(clickedCategory) {

        //クリックされたカテゴリーに紐づくitem
        let clickedCategoryItems = clickedCategory.items;
        //itemsがnullでなく、重複していなければfilteredDataに追加
        if (clickedCategoryItems != null) {
            clickedCategoryItems.forEach(item => {
                //すでにMapに追加されていなければ追加
                if (!filteredData.has(item.id)) {
                    filteredData.set(item.id, item);
                }
            });
        }

        // クリックされたカテゴリーの子カテゴリー
        let clickedCategoryChildren = clickedCategory.children;
        //子カテゴリーがある場合、子カテゴリーのitemsをMapに追加
        if(clickedCategoryChildren!=null){
            clickedCategoryChildren.forEach(childCategory => {
                //子カテゴリーに紐づくitemsを取得
                let childCategoryItems = childCategory.items;

                // 子カテゴリーに紐づくitemsがnullでなく、重複していなければfilteredDataに追加
                if (childCategoryItems != null) {
                    childCategoryItems.forEach(item => {
                        //すでにMapに追加されていなければ追加
                        if (!filteredData.has(item.id)) {
                            filteredData.set(item.id, item);
                        }
                    });
                }

                //childCategoryにさらに子カテゴリーがある場合、再帰的に処理
                if (childCategory.children && childCategory.children.length > 0) {
                    SetFilteredData(childCategory);
                }
            });
        }
    }

    // 戻るボタンをクリックした時の処理
    function BackToPreviousCategory() {

        // 戻るボタンを表示
        document.getElementById("back_btn").classList.remove("hidden");

        // 戻るボタンをクリックした時の処理
        document.getElementById("back_btn").onclick = function() {

            //カテゴリーidを1つ削除
            parentIdArray.pop();

            // 現在のカテゴリーの位置を示すh1要素
            let currentCategory = document.getElementById("current_category").innerText;

            // テーブルに1つ前のカテゴリーのデータを追加
            // ルートカテゴリーに戻る場合と、子カテゴリーに戻る場合でif分岐
            if( parentIdArray.length === 0){

                // 全てのルートカテゴリーを非表示
                parentCategoryBtns.forEach(category => {
                    category.classList.remove("hidden");
                });

                // 全ての子カテゴリーを非表示
                childCategoryBtns.forEach(category => {
                    category.classList.add("hidden");
                });

                // 現在のカテゴリーの位置を示すh1を空文字に
                document.getElementById("current_category").innerText = "";

                // 戻るボタンを非表示
                document.getElementById("back_btn").classList.add("hidden");

                // 現在のtbodyを削除
                if(document.getElementById("new_tbody") !== null){
                    document.getElementById("new_tbody").remove();
                }
                // デフォルトのtbodyを表示
                document.getElementById("default_tbody").classList.remove("hidden");
            }else{
                // 現在のカテゴリーを非表示
                HideAllCategoryBtn();

                // 1つ前のカテゴリーのボタンを表示
                ShowChildrenCategory(parentIdArray[parentIdArray.length - 1]);

                // 最後の " -> " 以降を削除
                document.getElementById("current_category").innerText = currentCategory.substring(0, currentCategory.lastIndexOf(" -> "));

                // 1つ前のデータをMapから取得
                let savedTbody  = previousTbodyData.get(parentIdArray[parentIdArray.length - 1]);
                console.log(savedTbody)
                // 現在のtbodyを削除
                if(document.getElementById("new_tbody") !== null){
                    document.getElementById("new_tbody").remove();
                }
                // 新しくMapより取得したtbodyを追加
                document.querySelector("table").appendChild(savedTbody);
            }
        };
    }
</script>
