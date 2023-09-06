<div>
    @if (!$is_allowed)
        <style>
            body {
                overflow: hidden;
            }
        </style>
    @endif
    <section class="container mx-auto my-10">

        @if (!$is_allowed)
            <div class="media">
                <div class="placeholder grid place-content-center">
                    <img src="{{ asset('placeholder.gif') }}" alt="placeholder">
                </div>
            </div>
            <div
                class="fixed top-0 left-0 right-0 z-10 p-4 overflow-x-hidden overflow-y-auto bg-[#0005] inset-0 justify-center items-center flex">
                <div class="relative w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <a href="{{ route('home') }}"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </a>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Please enter licence
                                key
                            </h3>
                            <form wire:submit.prevent="show">
                                <div class="mb-3">
                                    <input type="text"
                                        class="block m-auto w-10/12 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        wire:model="licence_key">
                                    <x-input-error :messages="$errors->get('licence_key')" class="mt-2" />
                                </div>
                                <x-primary-button>enter</x-primary-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @else
            @switch($file_type)
                @case('IMAGE')
                <x-image-container :src="$file_path"/>
                    @break
                @case(2)
                    
                    @break
                @default
                    
            @endswitch
        @endif

    </section>
</div>
