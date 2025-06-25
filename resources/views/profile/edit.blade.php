<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{--ログアウト--}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}"
                   onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    <div class="flex justify-center items-center gap-4 bg-red-500 py-4 rounded-lg w-[150px]">
                        <i class="fa-solid fa-arrow-right-from-bracket text-white"></i>
                        <p class="text-white">ログアウト</p>
                    </div>
                </a>
            </form>
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</x-app-layout>
