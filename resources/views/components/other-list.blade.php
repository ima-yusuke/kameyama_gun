{{--一覧--}}
<section class="flex gap-4 w-full px-4 h-full">
    {{-- テーブル表示エリア --}}
    <div class="w-full h-full overflow-y-auto">
        <table class="min-w-full table-fixed">
            <colgroup>
                <!-- 1列目：ID は固定 3rem -->
                <col class="w-16">
                <!-- 2列目：品名はテーブル幅の40% -->
                <col class="w-[25%]">
                <!-- 3列目：カテゴリーは自動 -->
                <col>
                <!-- 4列目：料金は自動 -->
                <col class="w-20">
                <!-- 5列目：在庫は固定 -->
                <col class="w-16">
                <!-- 6列目：備考欄は自動 -->
                <col>
            </colgroup>
            <thead>
            <tr>
                <th class="border border-gray-500 px-4 py-2">/</th>
                <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">品名</th>
                <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">カテゴリー</th>
                <th class="border border-gray-500 px-4 py-2">料金</th>
                <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">在庫</th>
                <th class="border border-gray-500 px-4 py-2">備考欄</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dataArray as $data)
                {{--その他でない（roleが2でない）場合はスキップ--}}
                @if($data->category["role"]!==2)
                    @continue
                @endif
                <tr>
                    <td class="border border-gray-500 px-4 py-4">
                        <div class="flex justify-center items-center">
                            {{ $data["id"] }}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-4 break-all">{{ $data["name"] }}</td>
                    <td class="border border-gray-500 px-4 py-4">
                        <div class="flex justify-center items-center">
                            {{$data->category["name"]}}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-4">
                        <div class="flex justify-center items-center">
                            {{ $data['price']==null?"-": "￥" .number_format($data['price'])}}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-4 {{$data['is_stock'] === 1 ? 'text-green-700':'text-red-500'}}">
                        <div class="flex justify-center items-center">
                            {{ $data["is_stock"]===1?"有":"無"}}
                        </div>
                    </td>
                    <td class="border border-gray-500 px-4 py-4 break-all">{{ $data["note"] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

