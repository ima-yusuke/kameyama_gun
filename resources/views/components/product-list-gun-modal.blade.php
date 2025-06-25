<!--modal -->
<div id="static-modal" class="hidden fixed inset-0 z-50 flex justify-center items-center min-h-screen bg-black/50">
    <!-- モーダル本体：縦レイアウト + 高さ制限 -->
    <div class="relative w-[90%] max-w-2xl max-h-[70%] bg-white rounded-lg shadow-sm dark:bg-gray-700 flex flex-col">

        <!-- ヘッダー（固定） -->
        <div class="relative flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            {{-- 品名 --}}
            <h3 id="modal_title" class="break-all md:text-xl font-semibold text-gray-900 dark:text-white"></h3>

            {{-- 閉じるボタン：親の relative を基準に絶対配置 --}}
            <button
                onclick="CloseGunModal()"
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
            {{-- 画像 --}}
            <div id="image_container">
                <p id="image_not_exist" class="hidden">画像が登録されていません</p>
                <img
                    data-base-url="{{ asset('storage/img/') }}"
                    id="modal_image"
                    src="{{asset('storage/img/logo_1.jpg')}}"
                    alt="gun"
                    class="object-cover w-full h-auto xl:h-[300px] md:h-[200px]"
                >
            </div>

            <aside class="flex flex-col md:flex-row md:flex-wrap md:justify-between gap-4 w-full">
                {{--品番--}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">品番</p>
                    <p id="modal_id" class="text-start w-full"></p>
                </div>
                {{-- カテゴリー --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">カテゴリー</p>
                    <p id="modal_category" class="text-start w-full"></p>
                </div>
                {{-- 生産国 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">生産国</p>
                    <p id="modal_country" class="text-start w-full"></p>
                </div>
                {{-- 価格 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">価格</p>
                    <p id="modal_price" class="text-start w-full"></p>
                </div>
                {{-- ブランド --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">ブランド</p>
                    <p id="modal_brand" class="text-start w-full"></p>
                </div>
                {{-- モデル --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">モデル</p>
                    <p id="modal_model" class="text-start w-full"></p>
                </div>
            </aside>

            <hr class="border-dashed border-gray-500">

            <aside class="flex flex-wrap justify-between gap-4 w-full">
                {{-- 全長 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">全長</p>
                    <p id="modal_full_length" class="text-start w-full"></p>
                </div>
                {{-- 総重量 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">総重量</p>
                    <p id="modal_full_weight" class="text-start w-full"></p>
                </div>
                {{-- 口径 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">口径</p>
                    <p id="modal_diameter" class="text-start w-full"></p>
                </div>
                {{-- 在庫 --}}
                <div class="flex flex-col items-center gap-2 w-full md:w-[45%]">
                    <p class="bg-gray-600 text-white py-1 w-full text-center">在庫</p>
                    <p id="modal_is_stock" class="text-start w-full"></p>
                </div>
            </aside>

            <hr class="border-dashed border-gray-500">

            <aside class="flex flex-wrap gap-4 w-full">
                {{-- 備考 --}}
                <div class="flex flex-col items-center md:items-start gap-2 w-full">
                    <p class="bg-gray-600 text-white py-1 w-full md:w-[45%] text-center">備考</p>
                    <p id="modal_note" class="text-start w-full"></p>
                </div>
            </aside>
        </div>
    </div>
</div>
<div id="modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>
