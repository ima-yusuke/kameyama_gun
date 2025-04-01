<nav class="bg-white">
    <div class="flex items-center justify-between mx-auto pl-10 py-4">
        <a href="/" class="flex items-center gap-2">
            <img src="{{asset("storage/img/logo_1.jpg")}}" class="h-10 w-10">
            <p class="hidden sm:flex items-center font-bold text-xl">亀山鉄砲</p>
        </a>

        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul class="flex items-center font-medium md:p-0 bg-white">
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <a href="/" class="block py-2 px-3" aria-current="page">
                        <i class="fa-solid fa-home pr-2"></i>ホーム
                    </a>
                </li>
                {{--カテゴリー--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <div>
                        <button data-dropdown-toggle="category" class="py-2 px-3 text-center">
                            <i class="fa-solid fa-list pr-2"></i>カテゴリー
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div id="category" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-list" title="カテゴリー登録" url="admin.category.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-briefcase" title="カテゴリー編集" url="admin.category.edit"/>
                        </ul>
                    </div>
                </li>
                {{--銃--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <button data-dropdown-toggle="gun" class="py-2 px-3">
                        <i class="fa-solid fa-gun pr-2"></i>
                        銃
                    </button>
                    <!-- Dropdown menu -->
                    <div id="gun" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-gun" title="銃登録" url="admin.gun.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="銃編集" url="admin.gun.edit"/>
                        </ul>
                    </div>
                </li>
                {{--弾--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <button data-dropdown-toggle="bullet" class="py-2 px-3">
                        <i class="fa-solid fa-circle pr-2"></i>
                        弾
                    </button>
                    <!-- Dropdown menu -->
                    <div id="bullet" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-circle" title="弾登録" url="admin.bullet.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="弾編集" url="admin.gun.show"/>
                        </ul>
                    </div>
                </li>
                {{--その他--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <button data-dropdown-toggle="other" class="py-2 px-3">
                        <i class="fa-solid fa-briefcase pr-2"></i>
                        その他
                    </button>
                    <!-- Dropdown menu -->
                    <div id="other" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-briefcase" title="その他登録" url="admin.gun.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="その他編集" url="admin.gun.show"/>
                        </ul>
                    </div>
                </li>
                {{--マイページ--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4 py-2">
                    <x-dash-nav-li-component icon="fa-solid fa-user" title="マイページ" url="profile.edit"/>
                </li>
                {{--ログアウト--}}
                <li class="flex justify-center px-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{route('logout')}}"
                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <div class="flex pl-2 items-center gap-4">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>ログアウト</p>
                            </div>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
