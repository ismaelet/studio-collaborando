@props([
    'type' => 'primary',
    'href' => null,
    'submit' => 'button',
])

@php
    $classes = 'button py-4 px-16 rounded-full font-heading text-sm sm:text-base';
@endphp

@pushOnce('styles')
    <style>
        .button {
            min-width: 12rem;

            &[data-type="primary"] {
                background-color: hsl(var(--color-primary-400-hsl));
                box-shadow: 0px 2rem 4rem -1rem hsl(var(--color-primary-400-hsl));
                color: #fff;
            }

            &[data-type="secondary"] {
                border: var(--border-width) solid currentColor;
                color: hsl(var(--color-primary-400-hsl));
            }
        }
    </style>
@endPushOnce

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}"
        data-type="{{ $type }}">{{ $slot }}</a>
@elseif ($submit)
    <button type="submit" {{ $attributes->class($classes) }}"
        data-type="{{ $type }}">{{ $slot }}</button>
@else
    <div {{ $attributes->class($classes) }}" data-type="{{ $type }}"></div>
@endif
