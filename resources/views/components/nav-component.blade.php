{{--tabコンテンツ--}}
<div id="default-tab-content" class="flex-1 h-full bg-gray-50">
    <div class="hidden rounded-lg bg-gray-50 h-full" id="gun" role="tabpanel" aria-labelledby="gun-tab">
        <x-gun-list :dataArray="$dataArray" :categories="$categories"></x-gun-list>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 h-full" id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
        <x-bullet-list :dataArray="$dataArray"></x-bullet-list>

    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 h-full" id="others" role="tabpanel" aria-labelledby="others-tab">
        <x-other-list :dataArray="$dataArray"></x-other-list>
    </div>
</div>
