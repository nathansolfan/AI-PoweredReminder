<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Title -->
            <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        Task Overview
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                        A quick summary of your tasks grouped by status and category.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Overdue Tasks -->
                <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg shadow-md relative">
                    <h3 class="text-lg font-bold text-red-700 dark:text-red-400">🔥 Overdue Tasks</h3>
                    @if($overdueTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No overdue tasks!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($overdueTasks->take(3) as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-amber-500 hover:text-amber-700"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('tasks.index') }}" class="absolute bottom-4 right-4 text-sm text-red-600 hover:underline">View More</a>
                </div>

                <!-- Today's Tasks -->
                <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg shadow-md relative">
                    <h3 class="text-lg font-bold text-yellow-700 dark:text-yellow-400">🌞 Today's Tasks</h3>
                    @if($todayTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No tasks for today!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($todayTasks->take(3) as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('tasks.index') }}" class="absolute bottom-4 right-4 text-sm text-yellow-600 hover:underline">View More</a>
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg shadow-md relative">
                    <h3 class="text-lg font-bold text-green-700 dark:text-green-400">📅 Upcoming Tasks</h3>
                    @if($upcomingTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No upcoming tasks!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($upcomingTasks->take(3) as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('tasks.index') }}" class="absolute bottom-4 right-4 text-sm text-green-600 hover:underline">View More</a>
                </div>

                <!-- Tasks by Category -->
                <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg shadow-md relative">
                    <h3 class="text-lg font-bold text-blue-700 dark:text-blue-400">📚 Tasks by Category</h3>
                    @if($categoryCounts->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No categories available!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($categoryCounts as $category)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $category->category ?? 'Uncategorized' }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $category->total }} task(s)</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('tasks.index') }}" class="absolute bottom-4 right-4 text-sm text-blue-600 hover:underline">View More</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
