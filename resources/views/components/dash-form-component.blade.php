<div class="flex w-full">
    {{--左側--}}
    <aside class="w-[30%] flex flex-col justify-center items-start gap-2 p-6 bg-gray-400 text-white font-bold">
        @if($flag)
            <p class="text-white text-sm bg-red-500 px-2 py-1 rounded-md border-2 border-solid border-red-500">必須</p>
        @endif
            <p class="text-white">{!! nl2br(e(str_replace('\n', "\n", $title))) !!}</p>
    </aside>

    {{--右側--}}
    <aside class="w-full p-6 border border-solid border-gray-400 flex flex-col justify-center">
        {{$slot}}
    </aside>
</div>
