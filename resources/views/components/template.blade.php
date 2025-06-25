<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>亀山鉄砲</title>
    <link rel="manifest" href="/build/manifest.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{--ハンバーガーメニュー用ライブラリ--}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/modal.js'])
</head>
<body class="min-h-screen h-screen overflow-hidden flex flex-col bg-[#FAFAFA]">

    <header>
        {{--ルートのnameが'product-list.show'のみ公式ホームページのメニュー表示（管理画面では非表示）--}}
        @if(request()->routeIs('product-list.show'))
            <x-product-list-nav />
        @endif

        {{--タブメニュー（銃・弾・その他）--}}
        <ul class="w-full flex justify-around bg-black" id="default-tab"
            data-tabs-toggle="#default-tab-content"
            data-tabs-active-classes="!bg-white"
            role="tablist">
            {{--銃--}}
            <li class="w-full border-b border-r flex items-center justify-center hover:bg-white" role="presentation">
                <button class="!text-[#B8955F] inline-block py-2 w-full h-full md:text-xl" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">
                    銃
                </button>
            </li>
            {{--弾--}}
            <li class="w-full border-b border-r flex items-center justify-center hover:bg-white" role="presentation">
                <button class="!text-[#B8955F] inline-block py-2 w-full h-full md:text-xl hover:text-gray-600 hover:border-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">
                    弾
                </button>
            </li>
            {{--その他--}}
            <li class="w-full border-b flex items-center justify-center hover:bg-white" role="presentation">
                <button class="!text-[#B8955F] inline-block py-2 w-full h-full md:text-xl hover:text-gray-600 hover:border-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">
                    その他
                </button>
            </li>
            {{--管理画面のみ、dashboardへのリンク表示--}}
            @if(request()->routeIs('admin.product-list.show'))
                <li class="w-full border-b flex items-center justify-center hover:bg-white" role="presentation">
                    <a href="{{route("dashboard")}}" class="!text-[#B8955F] inline-block text-center py-2 w-full h-full md:text-xl hover:text-gray-600 hover:border-gray-300" type="button">
                        管理画面
                    </a>
                </li>
            @endif
        </ul>
    </header>

    <main class="flex-1 overflow-y-scroll py-2 md:py-4">
        {{ $slot }}
    </main>

    {{--ユーザー画面のみfooter表示--}}
    @if(request()->routeIs('product-list.show'))
        <footer class="fixed bottom-0 w-full h-auto py-2 flex flex-col gap-2 items-center justify-center bg-[#B8955F]">
            <p class="text-sm font-bold tracking-widest">© Kameyama-gunshop</p>
        </footer>
    @endif

    {{--モーダルウィンドウ--}}

    {{--pwa--}}
    <script>
        // ServiceWorker登録：https://developers.google.com/web/fundamentals/primers/service-workers/?hl=ja
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }).catch(function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        }
    </script>
</body>
</html>
