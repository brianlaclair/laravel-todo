<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Tasks
        </h2>
    </x-slot>
    <div x-data="{ showCompleted: $persist(false) }">
        <div class="flex justify-center">
            <label class="flex items-center space-x-2 select-none">
                <input type="checkbox" x-model="showCompleted" class="rounded">
                <span>Show Completed Tasks</span>
            </label>
        </div>

        <div class="flex flex-col w-full my-5 space-y-2">
            <a href="{{ route('tasks.create') }}">
                <x-card class="bg-white text-center hover:bg-green-200 hover:scale-105 duration-150">
                    + new task
                </x-card>
            </a>

            @foreach($tasks as $task)
                <x-card
                    x-cloak
                    x-show="showCompleted || {{ !$task->completed ? 'true' : 'false' }}"
                    class="{{ $task->completed ? 'bg-green-200' : 'bg-white' }}"
                >
                    <div class="flex flex-row w-full justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs">{{ $task->completed ? "completed" : "waiting since" }} {{ $task->waitingTime() }}</span>
                            <span class="font-bold text-xl">{{ $task->title }}</span>
                            <span class="italic">{{ $task->description }}</span>
                        </div>
                        <div class="flex flex-col min-w-16 space-y-1 items-end">
                            <x-single-button-post method="PATCH" action="{{ route('tasks.toggle', $task->id) }}">{{ $task->completed ? "Undo" : "Done" }}</x-single-button-post>
                            @if ($task->completed)
                                <x-single-button-post class="bg-red-500 hover:bg-red-700" method="DELETE" action="{{ route('tasks.destroy', $task->id) }}">Remove</x-single-button-post>
                            @endif
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
