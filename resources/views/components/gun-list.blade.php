{{--一覧--}}
<table>
    <thead>
        <tr>
            <th class="border border-gray-500 px-4 py-2">/</th>
            <th class="border border-gray-500 px-4 py-2">品名（メーカー）</th>
            <th class="border border-gray-500 px-4 py-2">カテゴリー</th>
            <th class="border border-gray-500 px-4 py-2">口径</th>
            <th class="border border-gray-500 px-4 py-2">料金</th>
            <th class="border border-gray-500 px-4 py-2">ステータス</th>
            <th class="border border-gray-500 px-4 py-2">備考欄</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataArray as $data)
            {{--銃でない（roleが0でない）場合はスキップ--}}
            @if($data["role"]!==0)
                @continue
            @endif
            <tr data-gun="{{json_encode($data)}}" onclick="OpenModal(event)">
                <td class="border border-gray-500 px-4 py-2">{{ $data["id"] }}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $data["name"] }}</td>
                <td class="border border-gray-500 px-4 py-2">カテゴリー</td>
                <td class="border border-gray-500 px-4 py-2">口径</td>
                <td class="border border-gray-500 px-4 py-2">{{ number_format($data['price']) }}</td>
                <td class="border border-gray-500 px-4 py-2 {{$data['is_stock'] === true ? '':'text-red-500'}}">
                    {{ $data["is_stock"]===true?"在庫有":"売約済"}}
                </td>
                <td class="border border-gray-500 px-4 py-2">{{ $data["note"] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!--modal -->
<div id="static-modal" class="hidden fixed inset-0 z-50 flex justify-center items-center min-h-screen">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 id="modal_title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                <button type="button" id="modal-close-btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
        </div>
    </div>
</div>
<div id="modal_backdrop" class="hidden bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>

<script>
    const modal = document.getElementById('static-modal');//モダル要素
    const closeModalButton = document.getElementById('modal-close-btn');//モーダルクローズボタン
    const modalBackdrop = document.getElementById('modal_backdrop');//モダルオープン時のグレー背景

    // モーダルを閉じる
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');  // モーダルを非表示
        modalBackdrop.classList.add('hidden');  // バックドロップを非表示
    });

    // trをクリック時に発火
    function OpenModal(e){
        // モダルを開く
        modal.classList.remove('hidden');  // モーダルを表示
        modal.setAttribute('aria-hidden', 'false');
        modalBackdrop.classList.remove('hidden');  // バックドロップを表示

        // e.currentTargetで<tr>要素を取得
        let data = JSON.parse(e.currentTarget.getAttribute("data-gun"));
        const modalTitle = document.getElementById('modal_title');
        modalTitle.textContent = `${data.name} / モデル R33`;
    }
</script>
