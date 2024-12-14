<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Task List</h3>
                        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ New Task</a>
                    </div>

                    @if ($tasks->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">No tasks available. Start by creating one!</p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($tasks as $task)
                                <li class="py-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="text-md font-bold text-gray-900 dark:text-white">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Status: {{ ucfirst($task->status) }} | Category: {{ $task->category ?? 'Uncategorized' }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="px-3 py-1 text-yellow-500 bg-yellow-100 rounded-md hover:bg-yellow-200">Edit</a>
                                            <a href="{{ route('tasks.show', $task->id) }}" class="px-3 py-1 text-green-500 bg-green-100 rounded-md hover:bg-green-200">View</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-red-500 bg-red-100 rounded-md hover:bg-red-200">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
