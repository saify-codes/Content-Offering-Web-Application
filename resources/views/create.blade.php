<x-app-layout>
    <div>
        <div class="mx-auto">
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
                            <div class="wrapper">
                                @if (count($videos) === 0)
                                    <p class="text-sm font-bold text-center">No videos to show</p>
                                @endif
                                @foreach ($videos as $video)
                                    <div class="item flex mb-5 gap-5 p-4 rounded-2xl border">
                                        <div class="media relative">
                                            <video class="w-20 h-20 rounded-lg object-cover" preload="metadata">
                                                <source src="{{ asset('storage/' . $video->filepath) }}">
                                            </video>
                                            <div
                                                class="mask absolute inset-0 rounded-lg bg-[#0005] grid place-content-center cursor-pointer">
                                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 16 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 1.984v14.032a1 1 0 0 0 1.506.845l12.006-7.016a.974.974 0 0 0 0-1.69L2.506 1.139A1 1 0 0 0 1 1.984Z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="content">
                                            @if ($video->has_subscription)
                                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">subscription</span>
                                            @endif
                                            <h1 class="font-bold text-xl capitalize">{{ $video->title }}</h1>
                                            @php
                                                $content = substr($video->description, 0, 100);
                                                $length = strlen($content);
                                                $description = $length > 0 ? $content . '...' : 'no description';
                                            @endphp
                                            <p>{{ $description }}</p>
                                        </div>
                                        <div class="text-primary-500 text-xl price self-center ms-auto">
                                            <strong>${{ $video->price }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif(request()->routeIs('create.image'))
                            <div class="wrapper">
                                @if (count($images) === 0)
                                    <p class="text-sm font-bold text-center">No images to show</p>
                                @endif
                                @foreach ($images as $image)
                                    <div class="item flex mb-5 gap-5 p-4 rounded-lg border">
                                        <div class="media">
                                            <img class="w-20 h-20 rounded-lg"
                                                src="{{ asset('storage/' . $image->filepath) }}" alt="image">
                                        </div>
                                        <div class="content">
                                            @if ($image->has_subscription)
                                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">subscription</span>
                                            @endif
                                            <h1 class="font-bold text-xl capitalize">{{ $image->title }}</h1>
                                            @php
                                                $content = substr($image->description, 0, 100);
                                                $length = strlen($content);
                                                $description = $length > 0 ? $content . '...' : 'no description';
                                            @endphp
                                            <p>{{ $description }}</p>
                                        </div>
                                        <div class="text-primary-500 text-xl price self-center ms-auto">
                                            <strong>${{ $image->price }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif(request()->routeIs('create.document'))
                            <div class="wrapper">
                                @if (count($documents) === 0)
                                    <p class="text-sm font-bold text-center">No documnets to show</p>
                                @endif
                                @foreach ($documents as $document)
                                    <div class="item flex mb-5 gap-5 p-4 rounded-lg border">
                                        <div class="media">
                                            <img class="w-20 h-20 rounded-lg" src="{{ asset('icons/file.png') }}"
                                                alt="document">
                                        </div>
                                        <div class="content">
                                            @if ($document->has_subscription)
                                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">subscription</span>
                                            @endif
                                            <h1 class="font-bold text-xl capitalize">{{ $document->title }}</h1>
                                            @php
                                                $content = substr($document->description, 0, 100);
                                                $length = strlen($content);
                                                $description = $length > 0 ? $content . '...' : 'no description';
                                            @endphp
                                            <p>{{ $description }}</p>
                                        </div>
                                        <div class="text-primary-500 text-xl price self-center ms-auto">
                                            <strong>${{ $document->price }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
