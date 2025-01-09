<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a new Task
        </h2>
    </x-slot>

    <div class="flex flex-col my-5">
        <x-card
            x-data="{name:''}"
            class="w-full"
        >
            <form method="POST" class="w-1/2 flex flex-col space-y-2" action="{{ route('tasks.store') }}">
                @csrf
                <x-input-label>Task Name</x-input-label>
                <x-text-input x-model="name" class="w-full" name="title"></x-text-input>
                <x-input-label>Additional Info</x-input-label>
                <x-text-input class="w-full" name="description"></x-text-input>
                <x-primary-button
                    x-text="name ? `Add '${name}'` : 'Add Task'"
                ></x-primary-button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
