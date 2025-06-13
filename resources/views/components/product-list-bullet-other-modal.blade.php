<!--modal -->
<div id="bullet_other_modal" class="hidden fixed inset-0 z-50 flex justify-center items-center min-h-screen">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                {{--品名--}}
                <h3 id="bullet_other_modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                {{--閉じるボタン--}}
                <button onclick="CloseBulletOtherModal()" type="button" id="modal-close-btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <aside class="flex flex-wrap gap-4 w-full">
                    {{--カテゴリー--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">カテゴリー</p>
                        <p id="bullet_other_modal_category"></p>
                    </div>
                    {{--価格--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">価格</p>
                        <p id="bullet_other_modal_price"></p>
                    </div>
                    {{--在庫--}}
                    <div class="flex items-center gap-4 w-[45%]">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">在庫</p>
                        <p id="bullet_other_modal_is_stock"></p>
                    </div>
                </aside>
                <p class="w-full border-b border-dashed border-gray-500"></p>
                <aside class="flex flex-wrap gap-4 w-full">
                    {{--備考--}}
                    <div class="flex flex-col justify-center gap-4 w-full">
                        <p class="bg-gray-600 text-white py-1 w-[120px] text-center">備考</p>
                        <p id="bullet_other_modal_note"></p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<div id="bullet_other_modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
