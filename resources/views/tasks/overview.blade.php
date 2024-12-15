<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Overview</h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-2 gap-6">
            <!-- Overdue Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Overdue Tasks</h3>
                @if($overdueTasks->isEmpty())
                    <p>No overdue tasks!</p>
                @else
                    @foreach($overdueTasks as $task)
                        <p>{{ $task->title }}</p>
                    @endforeach
                @endif
            </div>

            <!-- Today's Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Today's Tasks</h3>
                @if($todayTasks->isEmpty())
                    <p>No tasks for today!</p>
                @else
                    @foreach($todayTasks as $task)
                        <p>{{ $task->title }}</p>
                    @endforeach
                @endif
            </div>

            <!-- Upcoming Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Upcoming Tasks</h3>
                @if($upcomingTasks->isEmpty())
                    <p>No upcoming tasks!</p>
                @else
                    @foreach($upcomingTasks as $task)
                        <p>{{ $task->title }}</p>
                    @endforeach
                @endif
            </div>

            <!-- Tasks by Category -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Tasks by Category</h3>
                @if($categoryCounts->isEmpty())
                    <p>No categories available!</p>
                @else
                    @foreach($categoryCounts as $category)
                        <p>{{ $category->category ?? 'Uncategorized' }}: {{ $category->total }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
