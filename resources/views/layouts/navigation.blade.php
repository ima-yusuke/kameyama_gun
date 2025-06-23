<nav class="bg-white sticky top-0 z-50">
    <div class="flex items-center justify-center lg:justify-start mx-auto py-4">
        <ul class="flex items-center font-medium md:p-0 bg-white">
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <a href="/" class="block py-2 px-3" aria-current="page">
                        ホーム
                    </a>
                </li>
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <a href="{{route("admin.product-list.show")}}" class="block py-2 px-3" aria-current="page">
                       商品一覧
                    </a>
                </li>
                {{--カテゴリー--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <div>
                        <button data-dropdown-toggle="category" class="py-2 px-3 text-center">
                            カテゴリー
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
                        弾
                    </button>
                    <!-- Dropdown menu -->
                    <div id="bullet" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-circle" title="弾登録" url="admin.bullet.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="弾編集" url="admin.bullet.edit"/>
                        </ul>
                    </div>
                </li>
                {{--その他--}}
                <li class="border-r border-dashed border-gray-500 flex justify-center px-4">
                    <button data-dropdown-toggle="other" class="py-2 px-3">
                        その他
                    </button>
                    <!-- Dropdown menu -->
                    <div id="other" class="z-10 hidden font-normal bg-white w-44">
                        <ul class="flex flex-col gap-4 py-2 text-sm text-gray-700">
                            <x-dash-nav-li-component icon="fa-solid fa-briefcase" title="その他登録" url="admin.other.show"/>
                            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="その他編集" url="admin.other.edit"/>
                        </ul>
                    </div>
                </li>
                {{--マイページ--}}
                <li class="border-gray-500 flex justify-center px-4 py-2">
                    <a href="{{route("profile.edit")}}" class="block py-2 px-3" aria-current="page">
                        マイページ
                    </a>
                </li>
            </ul>
    </div>
</nav>
