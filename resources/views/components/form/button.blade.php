@props([
    'scheme' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $classes = 'button px-16 rounded-full font-heading text-sm sm:text-base transition-colors';
@endphp

@pushOnce('styles')
    <style>
        .button {
            min-width: 12rem;

            &[data-scheme="primary"] {
                padding-block: 1rem;
                background-color: var(--color-primary-400);
                box-shadow: 0px 2rem 4rem -1rem var(--color-primary-400);
                color: #fff;

                &:hover {
                    background-color: var(--color-primary-500);
                }
            }

            &[data-scheme="secondary"] {
                padding-block: calc(1rem - var(--border-width));
                border: var(--border-width) solid currentColor;
                color: var(--color-primary-400);
            }
        }
    </style>
@endPushOnce

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}"
        data-scheme="{{ $scheme }}">{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}"
        data-scheme="{{ $scheme }}">{{ $slot }}</button>
@endif
