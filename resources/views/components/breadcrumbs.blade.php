<nav class="text-sm text-gray-600 dark:text-gray-400" aria-label="Breadcrumb">
    <ol class="inline-flex space-x-1">
        @foreach ($links as $name => $url)
            <li>
                @if ($loop->last)
                    <span class="text-gray-800 dark:text-gray-200 font-semibold">{{ $name }}</span>
                @else
                    <a href="{{ $url }}"
                        class="text-blue-600 dark:text-blue-400 hover:underline">{{ $name }}</a>
                    <span class="mx-1">/</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
