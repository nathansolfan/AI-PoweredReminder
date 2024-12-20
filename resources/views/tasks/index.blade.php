<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Task List</h3>
                        <div class="flex items-center space-x-4">
                            <!-- 🔍 Search Form -->
                            <form action="{{ route('tasks.index') }}" method="GET" class="flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search tasks..."
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <button type="submit"
                                    class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Search
                                </button>
                            </form>

                            <a href="{{ route('tasks.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 transition ease-in-out duration-150">
                                + New Task
                            </a>
                        </div>
                    </div>

                    @if ($tasks->isEmpty())
                        <div class="flex justify-center items-center py-10">
                            <p class="text-lg text-gray-500 dark:text-gray-400">No tasks available. Start by creating one!</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-300 dark:divide-gray-700">
                            @foreach ($tasks as $task)
                                <li class="py-6">
                                    <div class="flex justify-between items-center">
                                        <!-- Task Info -->
                                        <div>
                                            <h4
                                                class="text-lg font-bold {{ $task->deadline && $task->deadline < now() ? 'text-red-500' : ($task->deadline && $task->deadline <= now()->addDays(2) ? 'text-yellow-500' : 'text-gray-900 dark:text-white') }}">
                                                {{ $task->title }}
                                            </h4>
                                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                <strong>Status:</strong>
                                                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $task->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                                <strong class="ml-4">Category:</strong>
                                                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-sky-200 text-sky-800">
                                                    {{ $task->category ?? 'Uncategorized' }}
                                                </span>
                                            </p>

                                            <!-- Attachment Section -->
                                            @if ($task->attachment)
                                                <div class="mt-6">
                                                    <h5 class="text-sm font-medium text-gray-800 dark:text-gray-200">Attachment:</h5>

                                                    <div class="mt-4 flex items-center bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                                                        @if (Str::endsWith($task->attachment, ['jpg', 'jpeg', 'png']))
                                                            <!-- Image Preview -->
                                                            <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank">
                                                                <img src="{{ asset('storage/' . $task->attachment) }}"
                                                                    alt="Attachment"
                                                                    class="w-24 h-24 object-cover rounded-lg shadow hover:scale-105 transition-transform">
                                                            </a>
                                                        @elseif (Str::endsWith($task->attachment, ['pdf']))
                                                            <!-- PDF Icon -->
                                                            <div class="flex items-center">
                                                                <i class="far fa-file-pdf text-red-500 text-4xl"></i>
                                                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank" class="ml-2 text-blue-500 underline">
                                                                    View PDF
                                                                </a>
                                                            </div>
                                                        @else
                                                            <!-- Other File Type -->
                                                            <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank" class="text-blue-500 underline">
                                                                Download File
                                                            </a>
                                                        @endif

                                                        <!-- Delete Attachment Button -->
                                                        <form action="{{ route('tasks.deleteAttachment', $task->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this attachment?')"
                                                            class="ml-4">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Task Actions -->
                                        <div class="flex items-center space-x-4">
                                            <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-teal-600 text-white px-3 py-2 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                    {{ $task->status === 'pending' ? 'Mark as Completed' : 'Reopen Task' }}
                                                </button>
                                            </form>

                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="bg-amber-500 text-white px-3 py-2 rounded-md hover:bg-amber-600">
                                                Edit
                                            </a>

                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="bg-sky-500 text-white px-3 py-2 rounded-md hover:bg-sky-600">
                                                View
                                            </a>

                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-rose-600 text-white px-3 py-2 rounded-md hover:bg-rose-700">
                                                    Delete
                                                </button>
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
