 <x-single-layout>
     <div class="h-screen flex items-center justify-center">
         <div class="p-6 space-y-5">
             <svg class="text-red-600 w-16 h-16 mx-auto my-6" viewBox="0 0 20 20">
                <path fill="currentColor" d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
              </svg>
             <div class="text-center">
                 <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Failed!</h3>
                 <p class="text-gray-600 my-2">Something went wrong.</p>
                 <p> Try again </p>
                 <div class="p-10 text-center">
                     <a href="/"
                         class="inline-block px-6 py-3 bg-primary-500 hover:bg-secondary-500 text-white font-semibold">
                         GO BACK
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </x-single-layout>
