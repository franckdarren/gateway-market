@props(['active' => false, 'icone' => null])

@php
    $classes = $active
        ? 'flex items-center px-10 py-3 mt-4 text-[#5030E5] border-[#5030E5] border-l-4 '
        : 'flex items-center px-6 mx-4 py-2 mt-4 text-gray-100 hover:bg-[#5030E5] hover:rounded-md hover:bg-opacity-35 hover:text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icone)
        {!! $icone !!}
    @endif
    <span class="mx-3">{{ $slot }}</span>
</a>
