<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" name="subscription" class="sr-only peer" value="1" wire:model="subscription">
    <div
        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
    </div>
    <span data-tooltip-target="tooltip-default" class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
        <!-- subscription plan -->
        <svg class="inline-block w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        {{ var_dump($subscription) }}
    </span>


    <!-- tooltip -->
    <div id="tooltip-default" role="tooltip"
        class="absolute text-center z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Allow auto renewal subscription
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    {{-- <button type="button" >chnage</button> --}}
</label>
