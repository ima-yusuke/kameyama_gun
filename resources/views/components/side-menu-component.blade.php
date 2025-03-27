<nav class="w-full flex-1">
    <!-- Primary Navigation Menu -->
    <div class="px-2">
        <div class="flex flex-col gap-6">
            <ul class="flex flex-col gap-6">
                <x-dash-nav-li-component icon="fa-solid fa-gun" title="銃新規登録"/>
                <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="銃編集"/>
                <x-dash-nav-li-component icon="fa-solid fa-circle" title="弾新規登録"/>
                <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="弾編集"/>
                <x-dash-nav-li-component icon="fa-solid fa-briefcase" title="その他新規登録"/>
                <x-dash-nav-li-component icon="fa-solid fa-pen-to-square" title="その他編集"/>
            </ul>

            <p class="border-b border-solid border-gray-200"></p>

            <ul class="flex flex-col gap-6">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{route('logout')}}"
                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <x-dash-nav-li-component icon="fa-solid fa-arrow-right-from-bracket" title="ログアウト"/>
                    </a>
                </form>
            </ul>
        </div>
    </div>
</nav>
