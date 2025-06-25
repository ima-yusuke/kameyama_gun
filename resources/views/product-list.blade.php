<x-template>
    {{--取扱商品一覧--}}
    <section class="py-8 flex flex-col gap-8">
        <h1 class="text-xl md:text-4xl font-bold text-center w-full">取扱商品</h1>

        {{--tabコンテンツ--}}
        <div id="default-tab-content">
            {{--銃--}}
            <div id="gun" role="tabpanel" aria-labelledby="gun-tab">
                <x-product-list-gun :categories="$categories"></x-product-list-gun>
            </div>
            {{--弾--}}
            <div id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
                <x-product-list-bullet :categories="$categories"></x-product-list-bullet>
            </div>
            {{--その他--}}
            <div id="others" role="tabpanel" aria-labelledby="others-tab">
                <x-product-list-other :categories="$categories"></x-product-list-other>
            </div>
        </div>
    </section>

    {{--銃モダル要素とモダルオープン時のグレー背景を定義--}}
    <x-product-list-gun-modal></x-product-list-gun-modal>
    {{--弾とその他モダル要素とモダルオープン時のグレー背景を定義--}}
    <x-product-list-bullet-other-modal></x-product-list-bullet-other-modal>
</x-template>
