{{--一覧--}}
<table class="min-w-[85%]">
    <thead>
    <tr>
        <th class="border border-gray-500 px-4 py-2">/</th>
        <th class="border border-gray-500 px-4 py-2">品名</th>
        <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">カテゴリー</th>
        <th class="border border-gray-500 px-4 py-2">料金</th>
        <th class="border border-gray-500 px-4 py-2 whitespace-nowrap">在庫</th>
        <th class="border border-gray-500 px-4 py-2">備考欄</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($dataArray as $data)
        {{--弾でない（roleが1でない）場合はスキップ--}}
        @if($data->category["role"]!==1)
            @continue
        @endif
        <tr>
            <td class="border border-gray-500 px-4 py-4">
                <div class="flex justify-center items-center">
                    {{ $data["id"] }}
                </div>
            </td>
            <td class="border border-gray-500 px-4 py-4">{{ $data["name"] }}</td>
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
            <td class="border border-gray-500 px-4 py-4">{{ $data["note"] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

