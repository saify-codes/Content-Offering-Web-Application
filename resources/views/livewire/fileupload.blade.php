<div>
    <form wire:submit.prevent="save" novalidate>


        <div class="mb-6">
            <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File<span
                    class="text-red-500">*</span></label>
            <input type="file" class="p-2.5 ring-0" id="file" name="file" required wire:model="file">
            <x-input-error :messages="$errors->get('file')" class="mt-2" />
        </div>


        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title<span
                    class="text-red-500">*</span></label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                required placeholder="e.g. Funky" wire:model="title">
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price<span class="text-red-500">*</span></label>
            <div class="flex items-center flex-wrap justify-between gap-5">
                <input type="number" min="0" id="title" class="md:basis-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required placeholder="$0 - $1000" wire:model="price">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="subscription" value="1" class="sr-only peer" wire:change="subscription()">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></div>
                    <span data-tooltip-target="tooltip-default" class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{-- subscription plan
                        <svg class="inline-block w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                      </svg> --}}
                      {{var_dump($subscription)}}
                    </span>

                    <!-- tooltip -->
                    <div id="tooltip-default" role="tooltip" class="absolute text-center z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Allow auto renewal subscription
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
            
        </div>

        <div class="mb-6">
            <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration<span
                    class="text-red-500">*</span></label>
            <input type="number" min="1" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                required placeholder="duration in days" wire:model="duration">
            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="message" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Write your description here..." wire:model="description"></textarea>
        </div>

        
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{session('status')}}</div>
        @endif

        <button type="submit"
            class="text-white bg-primary-500 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>


    </form>


</div>
