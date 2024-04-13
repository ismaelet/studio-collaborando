@props(['title'])

<div class="flex gap-4 items-center">

    <a class="border rounded w-10 aspect-square hover:text-neutral-700 transition-colors"
        href="{{ route(App\Helpers\ArrayHelper::explodeLast('.', request()->route()->getName())[0] . '.list') }}">
        {!! embed_icon('navigation/previous', ['fill-none', 'h-1/3']) !!}
    </a>

    <x-dashboard.title-bar :title="str_replace('Modifica:', '<span class=\'font-light\'>Modifica:</span> ', $title)" />

</div>
