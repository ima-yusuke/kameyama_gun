<article class="w-full h-full flex flex-wrap justify-center items-center gap-x-4 gap-y-10">
    @foreach ($itemArray as $item)
        @if($item->category["role"] !== 2)
            @continue
        @endif
        {{--商品--}}
        <div class="w-[20%] flex flex-col p-4 border rounded">
            <aside class="w-full flex flex-col items-start">
                <p class="font-bold">{{$item["name"]}}</p>
                <p class="font-bold">￥{{ number_format($item['price']) }}</p>
                <p class="{{ $item['is_stock'] === 1 ? 'text-green-600':'text-red-500'}}">
                    {{ $item["is_stock"]===1?"在庫有":"在庫無" }}
                </p>
                <button class="border border-solid border-gray-800 px-4 py-1 rounded-sm mt-1">
                    詳細
                </button>
            </aside>
        </div>
    @endforeach
</article>
