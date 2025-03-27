<x-app-layout>
    <section class="w-full h-full flex items-center justify-center">
        <form class="w-[90%] flex flex-col gap-2">
            {{--品名--}}
            <x-dash-form-component :flag="true" title="品名">
                <input type="text" placeholder="ABC銃" name="name" class="rounded-lg">
            </x-dash-form-component>
            {{--商品モデル--}}
            <x-dash-form-component :flag="true" title="商品モデル">
                <input type="text" placeholder="R93" name="model" class="rounded-lg">
            </x-dash-form-component>
            {{--料金--}}
            <x-dash-form-component :flag="true" title="料金">
                <input type="number" placeholder="3000" name="price" class="rounded-lg">
            </x-dash-form-component>
            {{--生産国--}}
            <x-dash-form-component :flag="false" title="生産国">
                <input type="text" placeholder="日本" name="country" class="rounded-lg">
            </x-dash-form-component>
        </form>

    </section>
</x-app-layout>
