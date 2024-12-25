<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <!-- Add Breadcrumbs Here -->
    <div class="py-2">
        <x-breadcrumbs :links="[
            'Dashboard' => route('dashboard'),
            'Tasks' => route('tasks.index'),
        ]" />
    </div>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-900 shadow overflow-hidden sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <!-- Task List Title -->
                    <div class="mb-4 text-center">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Task List</h3>
                    </div>

                    <!-- Search Form -->
                    <div class="mb-6 flex justify-center">
                        <form action="{{ route('tasks.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search tasks..."
                                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <button type="submit"
                                class="ml-2 bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Search
                            </button>
                        </form>

                        <a href="{{ route('tasks.create') }}"
                            class="ml-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Create Task
                        </a>
                    </div>

                    <!-- Task List -->
                    @if ($tasks->isEmpty())
                        <div class="flex justify-center items-center py-6">
                            <p class="text-md text-gray-500 dark:text-gray-400">No tasks available. Start by creating
                                one!</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-300 dark:divide-gray-700">
                            @foreach ($tasks as $task)
                                <li class="py-4">
                                    <div
                                        class="flex flex-col lg:flex-row items-center justify-between items-start lg:items-center">
                                        <!-- Task Info -->
                                        <div class="flex-1 lg:w-2/3">
                                            <h4
                                                class="text-md font-bold {{ $task->deadline && $task->deadline < now() ? 'text-red-500' : ($task->deadline && $task->deadline <= now()->addDays(2) ? 'text-yellow-500' : 'text-gray-900 dark:text-white') }}">
                                                {{ $task->title }}
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                                                <strong>Status:</strong>
                                                <span
                                                    class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $task->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                                <strong class="ml-4">Deadline:</strong>
                                                <span
                                                    class="inline-block px-2 py-1 rounded-full text-xs font-medium
    {{ $task->deadline && $task->deadline < now() ? 'bg-red-200 text-red-800' : ($task->deadline && $task->deadline <= now()->addDays(2) ? 'bg-yellow-200 text-yellow-800' : 'bg-sky-200 text-sky-800') }}">
                                                    {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : 'Uncategorized' }}
                                                </span>
                                            </p>

                                            <!-- Expandable Description -->
                                            @if ($task->description)
                                                <button
                                                    class="mt-4 text-sm text-blue-500 hover:underline focus:outline-none focus:ring focus:ring-blue-300"
                                                    onclick="toggleDescription('{{ $task->id }}')">
                                                    Show Description
                                                </button>
                                                <div id="description-{{ $task->id }}"
                                                    class="mt-2 mx-auto p-3 max-w-md bg-gray-100 dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-300 rounded-md shadow hidden">
                                                    {{ $task->description }}
                                                </div>
                                            @endif
                                        </div>

                                        <script>
                                            function toggleDescription(id) {
                                                const description = document.getElementById(`description-${id}`);
                                                description.classList.toggle('hidden');
                                            }
                                        </script>

                                        <!-- Task Actions -->
                                        <div class="mt-4 lg:mt-0 flex justify-center space-x-2">
                                            <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-teal-600 text-white flex items-center justify-center w-24 h-10 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                    {{ $task->status === 'pending' ? 'Complete' : 'Reopen' }}
                                                </button>
                                            </form>

                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="bg-amber-500 text-white flex items-center justify-center w-10 h-10 rounded-md hover:bg-amber-600">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="bg-sky-500 text-white flex items-center justify-center w-10 h-10 rounded-md hover:bg-sky-600">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-rose-600 text-white flex items-center justify-center w-10 h-10 rounded-md hover:bg-rose-700">
                                                    <i class="fas fa-trash"></i>
                                                    <p>

                                                    </p>
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
