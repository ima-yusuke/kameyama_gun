{{--tabメニュー--}}
<div class="sticky top-0 z-50 border-b border-gray-200 w-full flex bg-[#FAFAFA]">
    {{--ロゴアイコン--}}
    <div class="z-10 bg-white w-[80px] h-[80px] border-r border-l border-gray-200 flex items-center justify-center">
        <img src="{{asset("storage/img/logo_1.jpg")}}" class="object-cover w-[50px] h-[50px]">
    </div>
    {{--タブメニュー--}}
    <ul class="w-full flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="bg-white w-[25%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">銃</p>
                    <p>Gun</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full hover:text-gray-600 hover:border-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">弾</p>
                    <p>Bullet</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] border-b border-r flex items-center justify-center" role="presentation">
            <button class="inline-block py-4 w-full h-full hover:text-gray-600 hover:border-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">その他</p>
                    <p>Others</p>
                </aside>
            </button>
        </li>
        <li class="bg-white w-[25%] border-b border-r flex items-center justify-center">
            <a target="_blank"
               href="https://www.kameyama-guns.com/?password-protected=login&redirect_to=https://www.kameyama-guns.com/"
               class="inline-block py-4 w-full h-full text-gray-500 hover:text-gray-600 hover:border-gray-300"
               id="admin-tab">
                <aside class="flex flex-col gap-1 items-center">
                    <p class="text-xl">お問合せ</p>
                    <p>Contact</p>
                </aside>
            </a>
        </li>
    </ul>
</div>

{{--tabコンテンツ--}}
<div id="default-tab-content" class="py-6 flex-1 bg-gray-50">
    <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="gun" role="tabpanel" aria-labelledby="gun-tab">
        <x-gun-list :dataArray="$dataArray" :categories="$categories"></x-gun-list>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
        <x-bullet-list :dataArray="$dataArray"></x-bullet-list>

    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full" id="others" role="tabpanel" aria-labelledby="others-tab">
        <x-other-list :dataArray="$dataArray"></x-other-list>
    </div>
</div>
