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

                        {{-- <div>
                            <label for="priority" class="block font-medium text-sm text-gray-700">Priority</label>
                            <select name="priority" id="priority" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div> --}}

                        <div>
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <div>
                            <label for="deadline" class="block font-medium text-sm text-gray-700">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" value="{{ old('deadline') }}" />
                        </div>

                        <div>
                            <label for="category" class="block font-medium text-sm text-gray-700">Category</label>
                            <select name="category" id="category" class="block w-full mt-1 rounded-md shadow-sm">
                                <option value="Work" {{old('category') == 'Work' ? 'selected' : ''}}>Work</option>
                                <option value="Personal" {{old('category') == 'Personal' ? 'selected' : ''}}>Personal</option>
                            </select>
                        </div>

                        <!-- File Upload -->
                        {{-- <div>
                            <label for="attachment" class="block font-medium text-sm text-gray-700">Attachment</label>
                            <input type="file" name="attachment" id="attachment" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        </div> --}}


                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
