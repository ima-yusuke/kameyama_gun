<x-template>
    {{--取扱商品一覧--}}
    <section class="py-8 flex flex-col gap-8">
        <h1 class="text-4xl font-bold text-center w-full">取扱商品</h1>

        {{--tabコンテンツ--}}
        <div id="default-tab-content">
            {{--銃--}}
            <div id="gun" role="tabpanel" aria-labelledby="gun-tab">
                <x-product-list-gun :itemArray="$itemArray" :categories="$categories"></x-product-list-gun>
            </div>
            {{--弾--}}
            <div id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
                <x-product-list-bullet :itemArray="$itemArray"></x-product-list-bullet>
            </div>
            {{--その他--}}
            <div id="others" role="tabpanel" aria-labelledby="others-tab">
                <x-product-list-other :itemArray="$itemArray"></x-product-list-other>
            </div>
        </div>
    </section>
</x-template>
