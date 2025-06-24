{{--銃商品一覧--}}
<article class="mx-8 flex flex-col gap-10">
    @foreach ($categories as $category)
        {{--カテゴリーのroleが0でない、またはそのカテゴリーに属する商品がない場合はスキップ--}}
        @if($category->items->isEmpty() || $category["role"] !== 0)
            @continue
        @endif

        {{--カテゴリー名とそのカテゴリーに属する商品を表示--}}
        <div class="w-full flex flex-col gap-6">
            {{--カテゴリー名--}}
            <h1 class="border-b border-[#B8955F] text-[#B8955F] w-full text-xl md:text-2xl font-bold pb-2">{{$category["name"]}}</h1>

            {{--同じカテゴリーの商品グループ--}}
            <div class="w-full h-full flex flex-col md:flex-row md:flex-wrap md:justify-start justify-center items-center gap-10">
                @foreach($category->items as $item)
                    {{--商品--}}
                    <div class="w-full md:w-[45%] lg:w-[20%] flex flex-col gap-4">
                        @if($item->gunDetail["image"]!=null)
                            <img src="{{ asset('storage/img/' . $item['id']."/". $item->gunDetail['image'] )}}" alt="{{ $item->gunDetail['name'] }}" class="w-full h-auto md:h-64 object-cover">
                        @else
                            <img src="{{ asset('storage/img/logo_1.jpg') }}" alt="gun" class="w-full h-auto md:h-64 object-cover">
                        @endif
                        <aside class="w-full flex flex-col items-start">
                            <p class="font-bold break-all">{{$item["name"]}}</p>
                            <p class="font-bold">
                                @if($item["price"]==null)
                                    価格お問合せ下さい
                                @else
                                    ￥{{ number_format($item['price']) }}
                                @endif
                            </p>
                            <p class="{{ $item['is_stock'] === 1 ? 'text-green-600':'text-red-500'}}">
                                {{ $item["is_stock"]===1?"在庫有":"在庫無" }}
                            </p>
                            <button onclick="OpenGunModal(event)" data-gun="{{json_encode($item)}}" data-gun-detail="{{json_encode($item->gunDetail)}}" data-category="{{json_encode($item->category)}}" class="border border-solid border-gray-800 px-4 py-1 rounded-sm mt-1">
                                詳細
                            </button>
                        </aside>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</article>



