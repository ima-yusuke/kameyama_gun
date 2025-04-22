<x-app-layout>
    <section class="w-full h-full flex items-center justify-center py-10">
        <form method="post" action="{{route("admin.category.add")}}"  class="w-[90%] flex flex-col gap-2">
            @csrf
            {{--分類--}}
            <x-dash-form-component :flag="true" title="分類">
                <select id="role_select" name="role" required class="rounded-lg">
                    <option value="">選択してください</option>
                    <option value="0">銃</option>
                    <option value="1">弾</option>
                    <option value="2">その他</option>
                </select>
            </x-dash-form-component>
            {{--親カテゴリー--}}
            <x-dash-form-component :flag="true" title="親カテゴリー">
                <select id="parent_select" name="parent_id" required class="rounded-lg">
                    <option value="">選択してください</option>
                    <option value="0">ルートカテゴリー</option>
                </select>
            </x-dash-form-component>
            {{--品名--}}
            <x-dash-form-component :flag="true" title="カテゴリー名">
                <input type="text" required placeholder="例）上下二連銃" name="name" class="rounded-lg">
            </x-dash-form-component>
            {{--登録ボタン--}}
            <div class="w-full flex justify-center pt-4">
                <button type="submit" class="w-24 py-4 bg-blue-500 text-white rounded-lg">登録</button>
            </div>
        </form>
    </section>
    <script>
        // 分類selectを選んだら発火
        document.getElementById('role_select').addEventListener('change', function() {
            let selectedRoleValue = this.value;

            if(selectedRoleValue == "") {
                // 選択されていない場合は何もしない
                return;
            }

            let parentSelect = document.getElementById('parent_select');

            // カテゴリーリストを取得
            let categories = {!! json_encode($categories) !!};

            // すべてのoptionを一旦クリア
            parentSelect.innerHTML = '<option value="">選択してください</option><option value="0">ルートカテゴリー</option>';

            // 選択されたroleに合致するカテゴリを追加
            // categories.forEach(category => {
            //     if (category.role == selectedRoleValue) {
            //         let option = document.createElement('option');
            //         option.value = category.id;
            //         option.textContent = category.name;
            //         parentSelect.appendChild(option);
            //     }
            // });

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
                    console.log(category)
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
                if (category.role == selectedRoleValue && category.parent_id == null) {
                    const newOptGroup = document.createElement('optgroup');
                    newOptGroup.label = category.name;
                    // 自分自身と子孫を再帰的に追加
                    addCategoryOptionsToOptGroup(category, newOptGroup);

                    parentSelect.appendChild(newOptGroup);
                }
            });
        });
    </script>
</x-app-layout>
