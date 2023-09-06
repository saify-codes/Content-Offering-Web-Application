@props(['src'])
<div x-data="{isOpen:false}">
    <div x-show="isOpen" class="lightbox p-3 fixed inset-0 bg-[#0008] flex justify-center items-center">
        <img class="h-full object-contain" src="{{asset("storage/$src")}}" alt="image">
        <button class="absolute z-10 top-4 right-4" @click="isOpen = !isOpen">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
        </button>
    </div>
    <div @click="isOpen = !isOpen" class="border border-red-600 h-[80vh] flex justify-center items-center cursor-zoom-in">
        <img class="h-full object-contain" src="{{asset("storage/$src")}}" alt="image">
    </div>
</div>