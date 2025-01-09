<div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
    <div {{ $attributes->merge(['class' => 'overflow-hidden shadow-sm sm:rounded-lg']) }}>
        <div class="p-6 text-gray-900">
            {{ $slot }}
        </div>
    </div>
</div>
