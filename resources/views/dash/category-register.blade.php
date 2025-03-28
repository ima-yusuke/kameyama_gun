<x-app-layout>
    <section class="w-full h-full flex items-center justify-center py-10">
        <form method="post" action="{{route("admin.category.add")}}"  class="w-[90%] flex flex-col gap-2">
            @csrf
            {{--親カテゴリー--}}
            <x-dash-form-component :flag="true" title="親カテゴリー">
                <select name="parent_id" required class="rounded-lg">
                    <option value="">選択してください</option>
                    <option value="0">ルートカテゴリー</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
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
</x-app-layout>
