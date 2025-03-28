<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="px-4 h-16 w-full flex justify-between">
        <!-- Logo -->
        <div class="shrink-0 flex items-center gap-2">
           <img src="{{asset("storage/img/logo_1.jpg")}}" class="h-10 w-10">
            <p class="hidden sm:flex items-center font-bold text-xl">亀山鉄砲</p>
        </div>

        <ul class="flex items-center">
            <x-dash-nav-li-component icon="fa-solid fa-gun" title="銃登録" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="銃編集" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-circle" title="弾登録" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="弾編集" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-briefcase" title="その他登録" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="その他編集" url="admin.gun.show"/>
            <x-dash-nav-li-component icon="fa-solid fa-user" title="マイページ" url="profile.edit"/>

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
        </ul>
    </div>
</nav>
