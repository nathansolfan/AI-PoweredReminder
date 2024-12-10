<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $task->title }}" class="block mt-1 w-full" required autofocus />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description" id="description" class="block mt-1 w-full">{{ $task->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="block font-medium text-sm text-gray-700">Priority</label>
                            <select name="priority" id="priority" class="block mt-1 w-full">
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="deadline" class="block font-medium text-sm text-gray-700">Deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline" value="{{ $task->deadline }}" class="block mt-1 w-full" />
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
