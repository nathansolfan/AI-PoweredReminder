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
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search tasks..."
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                >
                                <button
                                    type="submit"
                                    class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    Search
                                </button>
                            </form>

                            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 transition ease-in-out duration-150">
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
                            @foreach($tasks as $task)
                                <li class="py-6">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="text-lg font-bold {{ $task->deadline && $task->deadline < now() ? 'text-red-500' : ($task->deadline && $task->deadline <= now()->addDays(2) ? 'text-yellow-500' : 'text-gray-900 dark:text-white') }}">
                                                {{ $task->title }}
                                            </h4>
                                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                <strong>Status:</strong> <span class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $task->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                                <strong class="ml-4">Category:</strong> <span class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-sky-200 text-sky-800">
                                                    {{ $task->category ?? 'Uncategorized' }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white {{ $task->status === 'pending' ? 'bg-teal-600 hover:bg-teal-700' : 'bg-gray-700 hover:bg-gray-800' }} border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                    {{ $task->status === 'pending' ? 'Mark as Completed' : 'Reopen Task' }}
                                                </button>
                                            </form>

                                            <a href="{{ route('tasks.edit', $task->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                                Edit
                                            </a>

                                            <a href="{{ route('tasks.show', $task->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-sky-500 hover:bg-sky-600 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                                View
                                            </a>

                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
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

