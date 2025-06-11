<x-template>
    {{--公式ホームページのナビゲーションメニュー--}}
    <x-product-list-nav></x-product-list-nav>

    {{--取扱商品一覧--}}
    <section class="py-8">
        <h1 class="text-4xl font-bold text-center w-full">取扱商品</h1>

        <ul class="w-full flex justify-around" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">
                   銃
                </button>
            </li>
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl hover:text-gray-600 hover:border-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">
                    弾
                </button>
            </li>
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl hover:text-gray-600 hover:border-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">
                    その他
                </button>
            </li>
        </ul>

        {{--tabコンテンツ--}}
        <div id="default-tab-content" class="flex-1 h-full bg-gray-50">
            <div class="hidden rounded-lg bg-gray-50 h-full" id="gun" role="tabpanel" aria-labelledby="gun-tab">
                <x-product-list-gun :dataArray="$itemArray" :categories="$categories"></x-product-list-gun>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 h-full" id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
                <x-product-list-bullet :dataArray="$itemArray"></x-product-list-bullet>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 h-full" id="others" role="tabpanel" aria-labelledby="others-tab">
                <x-product-list-other :dataArray="$itemArray"></x-product-list-other>
            </div>
        </div>
        <div class="w-full">
            <article class="w-full flex flex-wrap">
                @foreach ($itemArray as $item)
                    {{--商品--}}
                    <div>
{{--                        @if($item->gunDetail["image"]==null)--}}
{{--                            画像なし--}}
{{--                        @else--}}
{{--                            <img src="{{ asset('storage/img/' . $item->gunDetail['image']) }}" alt="{{ $item->gunDetail['name'] }}" class="w-64 h-64 object-cover">--}}
{{--                        @endif--}}
                        @if($item->gunDetail!=null)
                            <img src="{{ asset('storage/img/' . $item['id']."/". $item->gunDetail['image'] )}}" alt="{{ $item->gunDetail['name'] }}" class="w-64 h-64 object-cover">
                        @endif

                    </div>
                @endforeach
            </article>
        </div>
    </section>
</x-template>
