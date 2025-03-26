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
        {{--弾でない（roleが1でない）場合はスキップ--}}
        @if($data["role"]!==1)
            @continue
        @endif
        <tr>
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
