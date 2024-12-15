<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Total Tasks</h3>
                <p class="text-4xl">{{ $totalTasks }}</p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Pending Tasks</h3>
                <p class="text-4xl">{{ $pendingTasks }}</p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-lg font-bold">Completed Tasks</h3>
                <p class="text-4xl">{{ $completedTasks }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
