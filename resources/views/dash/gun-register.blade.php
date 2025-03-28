<x-app-layout>
    <section class="w-full h-full flex items-center justify-center py-10">
        <form method="post" action="{{route("admin.gun.add")}}"  class="w-[90%] flex flex-col gap-2">
            @csrf
            {{--品名--}}
            <x-dash-form-component :flag="true" title="品名">
                <input type="text" required placeholder="例）ABC銃" name="name" class="rounded-lg">
            </x-dash-form-component>
            {{--在庫--}}
            <x-dash-form-component :flag="true" title="在庫">
                <div class="flex items-center gap-4">
                    <input type="radio" required name="is_stock" value="1" class="rounded-lg"> 有り
                    <input type="radio" required name="is_stock" value="0" class="rounded-lg"> 無し（売約済）
                </div>
            </x-dash-form-component>
            {{--メーカー--}}
            <x-dash-form-component :flag="false" title="メーカー">
                <input type="text" required placeholder="例）SIG SAUER" name="brand" class="rounded-lg">
            </x-dash-form-component>
            {{--商品モデル--}}
            <x-dash-form-component :flag="false" title="商品モデル">
                <input type="text" required placeholder="例）R93" name="model" class="rounded-lg">
            </x-dash-form-component>
            {{--生産国--}}
            <x-dash-form-component :flag="false" title="生産国">
                <input type="text" placeholder="例）日本" name="country" class="rounded-lg">
            </x-dash-form-component>
            {{--全長--}}
            <x-dash-form-component :flag="false" title="全長">
                <input type="number" step="any" required placeholder="例）125.6" name="full_length" class="rounded-lg">
            </x-dash-form-component>
            {{--総重量--}}
            <x-dash-form-component :flag="false" title="総重量">
                <input type="number" step="any" required placeholder="例）125.6" name="full_weight" class="rounded-lg">
            </x-dash-form-component>
            {{--口径--}}
            <x-dash-form-component :flag="false" title="口径">
                <input type="number" step="any" required placeholder="例）40" name="diameter" class="rounded-lg">
            </x-dash-form-component>
            {{--料金--}}
            <x-dash-form-component :flag="false" title="料金">
                <input type="number" required placeholder="例）3000" name="price" class="rounded-lg">
            </x-dash-form-component>
            {{--画像--}}
            <x-dash-form-component :flag="false" title="画像">
                <input type="file" required accept="image/png, image/jpeg, image/jpg" name="image" class="rounded-lg">
            </x-dash-form-component>
            {{--備考欄--}}
            <x-dash-form-component :flag="false" title="備考欄">
                <input type="text" placeholder="例）25個 /5,000円、50個 /9,000円、100個 /15,000円" name="note" class="rounded-lg">
            </x-dash-form-component>
            {{--登録ボタン--}}
            <div class="w-full flex justify-center pt-4">
                <button type="submit" class="w-24 py-4 bg-blue-500 text-white rounded-lg">登録</button>
            </div>
        </form>
    </section>
</x-app-layout>
