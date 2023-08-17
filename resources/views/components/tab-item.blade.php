@props(['active','href'])
@if ($active)
    <li class="mr-2">
        <a href="{{$href}}" class="inline-block p-4 text-primary-500 border-b-2 border-primary-500 rounded-t-lg active dark:text-primary-500 dark:border-primary-500">{{$slot}}</a>
    </li>
@else
    <li class="mr-2">
        <a href="{{$href}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{$slot}}</a>
    </li>
@endif
