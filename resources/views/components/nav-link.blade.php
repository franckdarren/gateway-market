@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center mt-2 px-1 pt-1 border-2  border-blue-400  bg-gradient-to-r from-[#3A88E9] to-[#0F468B] p-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out rounded-md transition'
            : 'inline-flex items-center mt-2 px-1 pt-1 border-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out rounded-md ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>