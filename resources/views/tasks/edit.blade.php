<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Existing Fields -->
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $task->title }}" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" required autofocus />
                        </div>
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description" id="description" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">{{ $task->description }}</textarea>
                        </div>
                        <div>
                            <label for="deadline" class="block font-medium text-sm text-gray-700">Deadline</label>
                            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline ? \Carbon\Carbon::parse($task->deadline)->toDateString() : '') }}" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <!-- Subtasks Section -->
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">Subtasks</h4>
                            <ul class="space-y-4">
                                @foreach ($task->subtasks as $subtask)
                                    <li class="flex items-center">
                                        <input type="text" name="subtasks[{{ $subtask->id }}][title]" value="{{ $subtask->title }}" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                                        <a href="{{ route('subtasks.destroy', $subtask->id) }}" class="ml-2 text-red-600 hover:text-red-800">Delete</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Add New Subtasks -->
                        <div>
                            <label for="new_subtasks" class="block font-medium text-sm text-gray-700">Add New Subtasks</label>
                            <textarea name="new_subtasks" id="new_subtasks" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Enter new subtasks, one per line"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Task
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
