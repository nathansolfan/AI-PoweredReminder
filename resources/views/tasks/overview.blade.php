<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Overdue Tasks -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-red-600 text-lg font-semibold">Overdue Tasks</h3>
                    @if($overdueTasks->isEmpty())
                        <p class="text-gray-600 mt-2">No overdue tasks!</p>
                    @else
                        <ul class="mt-2 space-y-2">
                            @foreach($overdueTasks as $task)
                                <li class="flex justify-between">
                                    <span>{{ $task->title }}</span>
                                    <span class="text-sm text-gray-500">{{ $task->deadline->format('d/m/Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Today's Tasks -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-yellow-600 text-lg font-semibold">Today's Tasks</h3>
                    @if($todayTasks->isEmpty())
                        <p class="text-gray-600 mt-2">No tasks due today!</p>
                    @else
                        <ul class="mt-2 space-y-2">
                            @foreach($todayTasks as $task)
                                <li>{{ $task->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-green-600 text-lg font-semibold">Upcoming Tasks</h3>
                    @if($upcomingTasks->isEmpty())
                        <p class="text-gray-600 mt-2">No upcoming tasks!</p>
                    @else
                        <ul class="mt-2 space-y-2">
                            @foreach($upcomingTasks as $task)
                                <li>{{ $task->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Tasks by Category -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-blue-600 text-lg font-semibold">Tasks by Category</h3>
                    @foreach($categoryCounts as $category)
                        <p>{{ $category->category ?? 'Uncategorized' }}: {{ $category->total }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
