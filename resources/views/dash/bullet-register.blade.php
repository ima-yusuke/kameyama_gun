<x-app-layout>
    <section class="w-full h-full flex items-center justify-center py-10">
        <form enctype="multipart/form-data" method="post" action="{{route("admin.bullet.add")}}"  class="w-[90%] flex flex-col gap-2">
            @csrf
            {{--品名--}}
            <x-dash-form-component :flag="true" title="弾名">
                <input type="text" required placeholder="例）ABC弾" name="name" class="rounded-lg">
            </x-dash-form-component>
            {{--カテゴリー--}}
            <x-dash-form-component :flag="true" title="カテゴリー">
                <select name="category_id" required class="rounded-lg">
                    @if(is_array($categories) && count($categoies)<1)
                        <option value="">カテゴリーを登録してください</option>
                    @else
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
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
            {{--料金--}}
            <x-dash-form-component :flag="false" title="料金">
                <input type="number" placeholder="例）3000" name="price" class="rounded-lg">
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
