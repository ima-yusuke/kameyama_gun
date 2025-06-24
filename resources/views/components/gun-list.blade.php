{{--現在のカテゴリーを表示する要素--}}
<h1 id="current_category" class="w-full font-bold text-xl p-6">全ての銃</h1>

<section class="flex gap-4 w-full px-4 h-full">
    {{-- テーブル表示エリア --}}
    <div class="w-[83%] h-full overflow-y-auto">
        <table class="w-full table-fixed">
            <colgroup>
                <!-- 1列目：ID は固定 3rem -->
                <col class="w-20">
                <!-- 2列目：品名はテーブル幅の40% -->
                <col class="w-[40%]">
                <!-- 3列目：カテゴリーは自動 -->
                <col>
                <!-- 4列目：在庫は固定 5rem -->
                <col class="w-20">
            </colgroup>
            <thead class="sticky top-0 bg-white z-10">
            <tr>
                <th class="border border-gray-500 py-2">/</th>
                <th class="border border-gray-500 px-4 py-2">品名</th>
                <th class="border border-gray-500 px-4 py-2">カテゴリー</th>
                <th class="border border-gray-500 px-4 py-2">在庫</th>
            </tr>
            </thead>
            <tbody id="default_tbody">
            @foreach ($dataArray as $data)
                @if($data->category["role"]!==0)
                    @continue
                @endif
                <tr>
                    <td class="border border-gray-500 px-4 py-4">
                        <div class="flex justify-center items-center">
                            <button data-gun="{{json_encode($data)}}" data-gun-detail="{{json_encode($data->gunDetail)}}" data-category="{{json_encode($data->category)}}" onclick="OpenGunModal(event)" class="button-21-open-modal py-2">
                                {{ $data["id"] }}<br>詳細
                            </button>
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-2 break-all">{{ $data["name"] }}</td>
                    <td class="border border-gray-500 px-4 py-2 text-center">{{ $data->category["name"] }}</td>
                    <td class="border border-gray-500 px-4 py-2 text-center {{ $data['is_stock'] === 1 ? 'text-green-700':'text-red-500'}}">{{ $data["is_stock"]===1?"有":"無" }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- フィルターメニュー --}}
    <div class="w-[17%] h-full overflow-y-auto">
        <ul class="w-full flex flex-col gap-6 text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="w-full flex items-center justify-center">
                <button class="button-21-gray !bg-gray-700 w-full !text-white px-4 py-2 rounded-lg">
                    カテゴリー選択
                </button>
            </li>
            @foreach($categories as $category)
                @if($category["parent_id"]!==null)
                    <li class="hidden w-full flex items-center justify-center" role="presentation">
                        <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" data-category="{{$category}}" data-children="{{$category->children}}" class="button-21 w-full text-gray-700 child-category px-4 py-2 rounded-lg" onclick="Filter(event)">
                            {{$category->name}}
                        </button>
                    </li>
                @else
                    <li class="w-full flex items-center justify-center" role="presentation">
                        <button data-id="{{$category['id']}}" data-parent-id="{{$category["parent_id"]}}" data-category="{{$category}}" data-children="{{$category->children}}" class="button-21 w-full text-gray-700 parent-category px-4 py-2 rounded-lg" onclick="Filter(event)">
                            {{$category->name}}
                        </button>
                    </li>
                @endif
            @endforeach
            <li class="w-full hidden flex items-center justify-center" role="presentation">
                <button id="back_btn" class="button-21-red w-full px-4 py-2 rounded-lg">
                    戻る
                </button>
            </li>
        </ul>
    </div>
</section>

<!--modal -->
<x-product-list-gun-modal></x-product-list-gun-modal>

<script>
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
        if(document.getElementById("current_category").innerText==="全ての銃"){
            document.getElementById("current_category").innerHTML += " -> " + event.currentTarget.innerText;
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

        row.innerHTML = `
            <td class="border border-gray-500 px-4 py-4">
                <div class="flex justify-center items-center">
                    <button
                        class="button-21-open-modal py-2"
                        data-gun='${JSON.stringify(data)}'
                        data-gun-detail='${JSON.stringify(data.gun_detail)}'
                        data-category='${JSON.stringify(data.category)}'
                        onclick="OpenGunModal(event)"
                    >
                        ${data.id}<br>詳細
                    </button>
                </div>
            </td>
            <td class="border border-gray-500 px-4 py-2 break-all">${data.name}</td>
            <td class="border border-gray-500 px-4 py-2">
                <div class="flex justify-center items-center">
                    ${data.category.name}
                </div>
            </td>
            <td class="border border-gray-500 px-4 py-2 ${data.is_stock === 1 ? 'text-green-700' : 'text-red-500'}">
                <div class="flex justify-center items-center">
                    ${data.is_stock === 1 ? "有" : "無"}
                </div>
            </td>
        `;

        tableBody.appendChild(row);
        document.querySelector("table").appendChild(tableBody);
    }

    //子カテゴリーを表示する関数
    function ShowChildrenCategory(clickedCategoryId) {
        childCategoryBtns.forEach(category => {
            if (category.getAttribute("data-parent-id") === clickedCategoryId) {
                category.parentNode.classList.remove("hidden");
            }
        });
    }

    //全カテゴリーを非表示にする関数
    function HideAllCategoryBtn() {

        //ルートカテゴリーを非表示
        parentCategoryBtns.forEach(category => {
            category.parentNode.classList.add("hidden");
        });

        //ルートカテゴリー以外を非表示
        childCategoryBtns.forEach(category => {
            category.parentNode.classList.add("hidden");
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
        document.getElementById("back_btn").parentNode.classList.remove("hidden");

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
                    category.parentNode.classList.remove("hidden");
                });

                // 全ての子カテゴリーを非表示
                childCategoryBtns.forEach(category => {
                    category.parentNode.classList.add("hidden");
                });

                // 現在のカテゴリーの位置を示すh1を空文字に
                document.getElementById("current_category").innerText = "全ての銃";

                // 戻るボタンを非表示
                document.getElementById("back_btn").parentNode.classList.add("hidden");

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
