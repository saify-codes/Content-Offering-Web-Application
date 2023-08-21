<div>
    <form wire:submit.prevent="save" novalidate>
        @error('file')
            <div class="p-4 mb-6 text-sm text-yellow-800 rounded-lg bg-yellow-50">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror

        <div data-mode="upload"
            class="drop__area group flex justify-center items-center mb-6 border-2 border-dashed rounded-lg h-56 border-primary-500 hover:bg-gray-100">

            <div id="upload" class="flex flex-col items-center gap-1">
                <label for="file"
                    class="px-4 py-2 cursor-pointer bg-primary-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Upload</label>
                <small>or drop file here</small>
                <input class="hidden" type="file" id="file" name="file"
                    accept="image/png, image/jpeg, image/gif" wire:model="file">
            </div>

            <!-- Preview -->
            <div wire:ignore id="preview" class="hidden relative"> </div>
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
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price<span
                    class="text-red-500">*</span></label>
            <input type="number" min="0" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                required placeholder="$0 - $1000" wire:model="price">
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

        <button type="submit"
            class="text-white bg-primary-500 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>


    </form>
</div>


<script>
    const dropArea = document.querySelector('.drop__area')
    const fileInput = document.querySelector('#file')
    const placeholder = document.querySelector('#preview')
    const discardBtn = document.querySelector('#discard')
    const submitBtn = document.querySelector('#submit__btn')


    dropArea.addEventListener('drop', e => {
        e.preventDefault()
        const selectedFile = e.dataTransfer.files[0]
        if (selectedFile) {
            dropArea.setAttribute('data-mode', 'preview')
            fileInput.files = e.dataTransfer.files
            if (selectedFile.type.includes('image')) {
                placeholder.innerHTML = `
                <div id="discard" class="cursor-pointer absolute right-2 top-2" onclick="discard()">
                    <svg class="w-6 h-6 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                </div>
                <img class="h-28 w-28 rounded-lg" src="${URL.createObjectURL(selectedFile)}" alt="preview">`
            } else {
                placeholder.innerHTML =
                    `
                <div id="discard" class="cursor-pointer absolute right-2 top-2" onclick="discard()">
                    <svg class="w-6 h-6 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                </div>
                <div class="h-28 w-28 rounded-lg text-center shadow-md font-bold grid place-content-center">Preview not available</div>`
            }
        }
    })

    dropArea.addEventListener('dragover', e => {
        e.preventDefault()
    })

    dropArea.addEventListener('dragenter', e => {
        e.preventDefault()
        console.log("dragging over!!");
    })

    fileInput.addEventListener('change', () => {
        const selectedFile = fileInput.files[0]
        if (selectedFile) {
            dropArea.setAttribute('data-mode', 'preview')
            if (selectedFile.type.includes('image')) {
                placeholder.innerHTML = `
                <div id="discard" class="cursor-pointer absolute right-2 top-2" onclick="discard()">
                    <svg class="w-6 h-6 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                </div>
                <img class="h-28 w-28 rounded-lg" src="${URL.createObjectURL(selectedFile)}" alt="preview">`
            } else {
                placeholder.innerHTML =
                    `
                <div id="discard" class="cursor-pointer absolute right-2 top-2" onclick="discard()">
                    <svg class="w-6 h-6 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                </div>
                <div class="h-28 w-28 rounded-lg text-center shadow-md font-bold grid place-content-center">Preview not available</div>`
            }
        }
    })


    function discard() {
        dropArea.setAttribute('data-mode', 'upload')
        fileInput.value = ''
    }
</script>
