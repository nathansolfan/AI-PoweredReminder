<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
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

                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" required autofocus value="{{ old('title') }}" />
                        </div>

                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description" id="description" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label for="deadline" class="block font-medium text-sm text-gray-700">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" value="{{ old('deadline') }}" />
                        </div>

                        <div>
                            <label for="category" class="block font-medium text-sm text-gray-700">Category</label>
                            <select name="category" id="category" class="block w-full mt-1 rounded-md shadow-sm">
                                <option value="Work" {{ old('category') == 'Work' ? 'selected' : '' }}>Work</option>
                                <option value="Personal" {{ old('category') == 'Personal' ? 'selected' : '' }}>Personal</option>
                            </select>
                        </div>

                        <!-- Subtasks Section -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Subtasks</label>
                            <div id="subtasks-container" class="space-y-4 mt-2">
                                <div class="flex space-x-4">
                                    <input type="text" name="subtasks[0][title]" class="flex-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Subtask title" />
                                    <button type="button" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="removeSubtask(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" id="add-subtask-button" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Add Subtask
                            </button>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subtasksContainer = document.getElementById('subtasks-container');
            const addSubtaskButton = document.getElementById('add-subtask-button');
            let subtaskIndex = 1;

            addSubtaskButton.addEventListener('click', function () {
                const subtaskTemplate = `
                    <div class="flex space-x-4">
                        <input type="text" name="subtasks[${subtaskIndex}][title]" class="flex-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Subtask title" />
                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="removeSubtask(this)">Remove</button>
                    </div>
                `;
                subtasksContainer.insertAdjacentHTML('beforeend', subtaskTemplate);
                subtaskIndex++;
            });
        });

        function removeSubtask(button) {
            button.parentElement.remove();
        }
    </script>
</x-app-layout>
