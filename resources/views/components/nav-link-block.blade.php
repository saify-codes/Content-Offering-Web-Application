@php
    $classes = "block text-white bg-primary-500 hover:bg-secondary-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>{{$slot}}</a>