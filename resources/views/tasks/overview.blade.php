<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Overview</h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-2 gap-6">
            <!-- Overdue Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3>Overdue Tasks</h3>
                @foreach($overdueTasks as $task)
                    <p>{{ $task->title }}</p>
                @endforeach
            </div>

            <!-- Today's Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3>Today's Tasks</h3>
                @foreach($todayTasks as $task)
                    <p>{{ $task->title }}</p>
                @endforeach
            </div>

            <!-- Upcoming Tasks -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3>Upcoming Tasks</h3>
                @foreach($upcomingTasks as $task)
                    <p>{{ $task->title }}</p>
                @endforeach
            </div>

            <!-- Tasks by Category -->
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3>Tasks by Category</h3>
                @foreach($categoryCounts as $category)
                    <p>{{ $category->category }}: {{ $category->total }}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
