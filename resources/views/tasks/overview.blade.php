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
                <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-red-700 dark:text-red-400 flex items-center">
                        🔥 Overdue Tasks
                    </h3>
                    @if($overdueTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No overdue tasks!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($overdueTasks as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $task->deadline->format('d/m/Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Today's Tasks -->
                <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-yellow-700 dark:text-yellow-400 flex items-center">
                        🌞 Today's Tasks
                    </h3>
                    @if($todayTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No tasks for today!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($todayTasks as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-green-700 dark:text-green-400 flex items-center">
                        📅 Upcoming Tasks
                    </h3>
                    @if($upcomingTasks->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No upcoming tasks!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($upcomingTasks as $task)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $task->title }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $task->deadline->format('d/m/Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Tasks by Category -->
                <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-blue-700 dark:text-blue-400 flex items-center">
                        📚 Tasks by Category
                    </h3>
                    @if($categoryCounts->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">No categories available!</p>
                    @else
                        <ul class="mt-4 space-y-3">
                            @foreach($categoryCounts as $category)
                                <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-3 rounded-md shadow-sm">
                                    <span class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $category->category ?? 'Uncategorized' }}
                                    </span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $category->total }} task(s)
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
