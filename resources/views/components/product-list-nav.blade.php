<nav x-data="{ open: false }" class="bg-[#E5DDCE]" >

    <div class="md:hidden w-full flex justify-end relative z-50">
        <button
            @click="open = !open"
            class="text-2xl focus:outline-none bg-[#B93728] text-white h-10 w-10"
        >
            <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
        </button>
    </div>
    <!-- ハンバーガーボタン（md以下で表示） -->


    <!-- PC用メニュー（md以上で表示） -->
    <ul class="bg-[#E5DDCE] hidden md:flex justify-around">
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">HOME</a>
        </li>
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/service" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">事業内容</a>
        </li>
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/news" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">お知らせ</a>
        </li>
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/product" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">取扱商品</a>
        </li>
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/beginner" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">猟銃をはじめたい方へ</a>
        </li>
        <li class="w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/company" class="font-bold w-full h-full text-center py-6 hover:text-[#B93728]">会社案内</a>
        </li>
        <li class="bg-[#B93728] w-full flex justify-center items-center">
            <a href="https://www.kameyama-guns.com/contact" class="font-bold text-white w-full h-full text-center py-6 hover:bg-black">
                <i class="fa-solid fa-envelope text-white pr-1"></i>
                お問い合わせ
            </a>
        </li>
    </ul>

    <!-- モバイル用メニュー（md以下で表示） -->
    <nav
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition transform ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 w-[85%] h-full bg-[#E5DDCE] shadow-lg md:hidden z-40"
    >
        <ul class="flex flex-col items-start gap-2 py-8 w-full">
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/" class="font-bold w-full h-full py-4">HOME</a>
            </li>
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/service" class="font-bold w-full h-full py-4">事業内容</a>
            </li>
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/news" class="font-bold w-full h-full py-4">お知らせ</a>
            </li>
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/product" class="font-bold w-full h-full py-4">取扱商品</a>
            </li>
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/beginner" class="font-bold w-full h-full py-4">猟銃をはじめたい方へ</a>
            </li>
            <li class="pl-4 w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/company" class="font-bold w-full h-full py-4">会社案内</a>
            </li>
            <li class="pl-4 p-2 bg-[#B93728] w-full flex justify-start">
                <a href="https://www.kameyama-guns.com/contact" class="font-bold text-white w-full h-full py-4">
                    <i class="fa-solid fa-envelope text-white pr-1"></i>
                    お問い合わせ
                </a>
            </li>
        </ul>
    </nav>
</nav>
