@props(['active'=>false])
@php
    $classes = 'block text-left px-3 hover:bg-gray-300 focus:text-white focus:bg-gray-300 hover:text-white';
    if($active) $classes = 'block px-3 text-left bg-blue-500 text-white';
@endphp

<a {{ $attributes(['class' => $classes])}}
    >{{ $slot }}</a>
