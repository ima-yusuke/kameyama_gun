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
    <main class="flex-1 overflow-hidden ">
        {{ $slot }}
    </main>

    <footer class="h-[5dvh] flex items-center justify-center bg-[#FAFAFA]">
        <p class="text-sm text-gray-500">© 2025 Kameyama Guns. All rights reserved.</p>
    </footer>
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
