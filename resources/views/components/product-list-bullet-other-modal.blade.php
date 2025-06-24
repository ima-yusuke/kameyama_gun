<!--modal -->
<div id="bullet_other_modal" class="hidden fixed inset-0 z-50 flex justify-center items-center min-h-screen">

    <div class="relative w-[90%] max-w-2xl max-h-[70%] bg-white rounded-lg shadow-sm dark:bg-gray-700 flex flex-col">

        <!-- ヘッダー（固定） -->
        <div class="relative flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            {{-- 品名 --}}
            <h3 id="bullet_other_modal_title" class="md:text-xl font-semibold text-gray-900 dark:text-white"></h3>

            {{-- 閉じるボタン：親の relative を基準に絶対配置 --}}
            <button
                onclick="CloseBulletOtherModal()"
                type="button"
                id="modal-close-btn"
                class="text-red-500 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="static-modal"
            >
                <svg class="w-6 h-6 font-bold" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <!-- 本文（スクロール） -->
        <div class="p-4 md:p-5 space-y-4 overflow-y-auto">
            <aside class="flex flex-col md:flex-row md:flex-wrap md:justify-between gap-8 w-full">
                {{--品番--}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">品番</p>
                    <p id="bullet_other_modal_id" class="text-start w-full"></p>
                </div>
                {{--カテゴリー--}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">カテゴリー</p>
                    <p id="bullet_other_modal_category" class="text-start w-full"></p>
                </div>
                {{--価格--}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">価格</p>
                    <p id="bullet_other_modal_price" class="text-start w-full"></p>
                </div>
                {{--在庫--}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">在庫</p>
                    <p id="bullet_other_modal_is_stock" class="text-start w-full"></p>
                </div>
            </aside>
            <p class="w-full border-b border-dashed border-gray-500"></p>
            {{--備考--}}
            <div class="flex flex-col items-center md:items-start gap-2 w-full">
                <p class="bg-gray-600 text-white py-1 w-full md:w-[45%] text-center">備考</p>
                <p id="bullet_other_modal_note" class="text-start w-full"></p>
            </div>
        </div>
    </div>
</div>
<div id="bullet_other_modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
