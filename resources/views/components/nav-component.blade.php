<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 px-10 border-b-2 rounded-t-lg" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">銃</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 px-10 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">弾</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 px-10 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">その他</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 px-10 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="admin-tab" data-tabs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="false">管理画面</button>
        </li>
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="gun" role="tabpanel" aria-labelledby="gun-tab">
      <x-guns-list></x-guns-list>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="bullet" role="tabpanel" aria-labelledby="bullet-tab">
        銃一覧
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="others" role="tabpanel" aria-labelledby="others-tab">
        その他一覧
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="admin" role="tabpanel" aria-labelledby="admin-tab">
    管理画面へのリンク
    </div>
</div>
