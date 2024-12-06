@props(['active' => false, 'icone' => null])

@php
    $classes = $active
        ? 'flex items-center px-6 py-2 mt-4 text-gray-100 rounded-md mx-4 bg-white bg-opacity-55 '
        : 'flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-white hover:rounded-md mx-4 hover:bg-opacity-35 hover:text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icone)
        {!! $icone !!}
    @endif
    <span class="mx-3">{{ $slot }}</span>
</a>
