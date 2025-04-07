{{--tabメニュー--}}
<div class="border-b border-gray-200 w-full flex bg-[#FAFAFA] relative">
    {{--ロゴアイコン--}}
    <div class="z-10 bg-white w-[150px] h-[150px] border-r border-l border-gray-200 flex items-center justify-center">
        <img src="{{asset("storage/img/logo_1.jpg")}}" class="object-cover w-[80px] h-[80px]">
    </div>
    {{--タブメニュー--}}
    <ul class="w-full flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="bg-white w-[25%] h-[50%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">銃</p>
                    <p>Gun</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] h-[50%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full hover:text-gray-600 hover:border-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">弾</p>
                    <p>Bullet</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] h-[50%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full hover:text-gray-600 hover:border-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">その他</p>
                    <p>Others</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] h-[50%] border-b border-r flex items-center justify-center">
            <a href="/dashboard" class="inline-block py-4 w-full h-full hover:text-gray-600 hover:border-gray-300" id="admin-tab" data-tabs-target="#admin" role="tab">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">管理画面</p>
                    <p>Administrator</p>
                </aside>
            </a>
        </li>
    </ul>
    {{--アニメーションのための要素--}}
    <p class="h-[50%] animate-slide">新品・中古問わず、いろいろな商品をご用意しています。お気軽にご相談ください！</p>
</div>

{{--tabコンテンツ--}}
<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="gun" role="tabpanel" aria-labelledby="gun-tab">
        <x-gun-list :dataArray="$dataArray" :categories="$categories"></x-gun-list>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
        <x-bullet-list :dataArray="$dataArray"></x-bullet-list>

    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="others" role="tabpanel" aria-labelledby="others-tab">
        <x-other-list :dataArray="$dataArray"></x-other-list>
    </div>

    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="admin" role="tabpanel" aria-labelledby="admin-tab">
        {{--aタグで管理画面に飛ぶため、この要素は表示されないがflowbiteの使用上配置--}}
        管理画面へのリンク
    </div>
</div>
