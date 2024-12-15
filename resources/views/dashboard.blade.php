<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>


        <div class="mt-8">
            <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">View Tasks</a>
            <a href="{{ route('overview') }}" class="bg-green-500 text-white px-4 py-2 rounded">View Overview</a>
        </div>
    </div>
</x-app-layout>
