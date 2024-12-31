<div>
    <h5 class="mt-4 text-sm font-bold">Subtasks:</h5>
    @if ($subtasks->isNotEmpty())
        <ul class="ml-4 mt-2">
            @foreach ($subtasks as $subtask)
                <li class="text-sm flex items-center justify-between mt-2">
                    <!-- Subtask Title -->
                    <div class="flex items-center space-x-2">
                        <span class="font-semibold {{ $subtask->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                            {{ $subtask->title }}
                        </span>
                        @if (!empty($subtask->description))
                            <span class="text-xs text-gray-500">{{ $subtask->description }}</span>
                        @endif
                    </div>

                    <!-- Subtask Actions -->
                    <div class="flex items-center space-x-2">
                        <!-- Toggle Completion -->
                        <form action="{{ route('subtasks.toggleStatus', $subtask->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="text-sm px-2 py-1 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none">
                                {{ $subtask->status === 'pending' ? 'Complete' : 'Reopen' }}
                            </button>
                        </form>

                        <!-- Delete Subtask -->
                        <form action="{{ route('subtasks.destroy', $subtask->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this subtask?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-sm px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500 mt-2">No subtasks available for this task.</p>
    @endif
</div>
