@props(['action' => '#', 'method' => ''])

<form class="h-full" method="POST" action="{{ $action }}">
    @csrf
    @method($method)
    <x-secondary-button {{ $attributes->merge(['class' => '']) }} type="submit">{{ $slot }}</x-secondary-button>
</form>
