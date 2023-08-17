<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-tab>
                        <x-tab-item :active="request()->routeIs('create.video')" :href="route('create.video')">Videos</x-tab-item>
                        <x-tab-item :active="request()->routeIs('create.image')" :href="route('create.image')">Images</x-tab-item>
                        <x-tab-item :active="request()->routeIs('create.document')" :href="route('create.document')">Documents</x-tab-item>
                        <x-tab-item :active="request()->routeIs('create.upload')" :href="route('create.upload')">Upload</x-tab-item>
                    </x-tab>

                    <div class="container mt-5">
                        @if (request()->routeIs('create.upload'))
                            <div class="upload">
                                @livewire('fileupload')
                            </div>
                        @elseif(request()->routeIs('create.video'))
                            <div class="content p-2">
                                <ul>
                                    @for ($i = 0; $i < 200; $i++)
                                        <li>{{ $i }}</li>
                                    @endfor
                                </ul>
                            </div>
                        @endif
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
