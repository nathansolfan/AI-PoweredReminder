<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-900 shadow overflow-hidden sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Your Notifications</h3>

                    @forelse ($notifications as $notification)
                        <div class="border-b py-3">
                            <p class="text-sm font-semibold">
                                {{ $notification->data['title'] }}
                            </p>
                            <p class="text-sm">
                                {{ $notification->data['message'] }}
                            </p>
                            <span class="text-xs text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs text-blue-500 hover:underline">Mark as Read</button>
                            </form>

                        </div>
                    @empty
                        <p class="text-gray-500">You have no notifications.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
