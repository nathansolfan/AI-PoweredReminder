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
                        <div class="border-b py-3 {{ $notification->read_at ? 'bg-gray-100 dark:bg-gray-800' : 'bg-blue-50 dark:bg-blue-900' }}">
                            <!-- Title -->
                            <p class="text-md font-bold {{ $notification->read_at ? 'text-gray-500 line-through' : 'text-gray-800 dark:text-white' }}">
                                {{ $notification->data['title'] }}
                            </p>

                            <!-- Message -->
                            <p class="text-sm mt-1 {{ $notification->read_at ? 'text-gray-400 line-through' : 'text-gray-600 dark:text-gray-300' }}">
                                {{ $notification->data['message'] }}
                            </p>

                            <!-- Timestamp -->
                            <span class="text-xs text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                            <!-- Mark as Read/Unread Button -->
                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">
                                    {{ $notification->read_at ? 'Mark as Unread' : 'Mark as Read' }}
                                </button>
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
