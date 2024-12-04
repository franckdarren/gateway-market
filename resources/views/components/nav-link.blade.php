@props(['active' => false, 'icone' => null])

@php
    $classes = $active
        ? 'flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25'
        : 'flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icone)
        {!! $icone !!}
    @endif
    <span class="mx-3">{{ $slot }}</span>
</a>
