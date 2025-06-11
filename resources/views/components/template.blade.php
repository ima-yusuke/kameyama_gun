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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen overflow-hidden flex flex-col bg-[#FAFAFA]">

    <header>
        {{--公式ホームページのナビゲーションメニュー--}}
        <x-product-list-nav></x-product-list-nav>

        {{--タブメニュー（銃・弾・その他）--}}
        <ul class="w-full flex justify-around" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            {{--銃--}}
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl" id="gun-tab" data-tabs-target="#gun" type="button" role="tab" aria-controls="gun" aria-selected="false">
                    銃
                </button>
            </li>
            {{--弾--}}
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl hover:text-gray-600 hover:border-gray-300" id="bullet-tab" data-tabs-target="#bullet" type="button" role="tab" aria-controls="bullet" aria-selected="false">
                    弾
                </button>
            </li>
            {{--その他--}}
            <li class="bg-white w-full border-b border-r flex items-center justify-center" role="presentation">
                <button class="inline-block py-2 w-full h-full text-xl hover:text-gray-600 hover:border-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">
                    その他
                </button>
            </li>
        </ul>
    </header>

    <main class="flex-1 overflow-scroll">
        {{ $slot }}
    </main>

    <footer class="h-[5dvh] flex items-center justify-center bg-[#B8955F]">
        <p class="text-sm font-bold tracking-widest">© Kameyama-gunshop</p>
    </footer>

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
