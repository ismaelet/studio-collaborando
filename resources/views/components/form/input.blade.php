@php
    $classes = '';
@endphp

@pushOnce('styles')
    <style>

    </style>
@endPushOnce

<input {{ $attributes }} {{ $attributes->class($classes) }}" />
