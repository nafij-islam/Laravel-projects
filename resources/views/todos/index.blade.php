@extends('layouts.app')

@section('title', 'All Todos')

@section('content')
    @forelse ($todos as $todo)
        @if ($loop->first)
            <!-- Simple row-based list design without blue color -->
            <div class="bg-white rounded-lg border border-gray-200 divide-y divide-gray-200">
        @endif

            <!-- Todo item row -->
            <div class="p-4 flex items-start justify-between gap-4 hover:bg-gray-50">
                <div class="flex items-start gap-3">
                    <!-- Toggle form -->
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="mt-1 w-5 h-5 rounded border-2 flex items-center justify-center {{ $todo->is_completed ? 'bg-green-500 border-green-500 text-white' : 'border-gray-300' }}">
                            @if ($todo->is_completed) &#10003; @endif
                        </button>
                    </form>

                    <!-- Content details -->
                    <div>
                        <h2 class="font-semibold {{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-900' }}">{{ $todo->title }}</h2>

                        @if ($todo->description)
                            <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                        @endif

                        @if ($todo->due_date)
                            <p class="text-sm mt-1 {{ \Carbon\Carbon::parse($todo->due_date)->isPast() && ! $todo->is_completed ? 'text-red-600' : 'text-gray-500' }}">
                                Due: {{ \Carbon\Carbon::parse($todo->due_date)->format('d M Y') }}
                            </p>
                        @endif

                        @if ($todo->attachment)
                            @php($isImage = in_array(strtolower(pathinfo($todo->attachment, PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                            @if ($isImage)
                                <a href="{{ asset('storage/' . $todo->attachment) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $todo->attachment) }}" alt="{{ $todo->attachment_name }}" class="mt-2 h-20 rounded border border-gray-200 object-cover">
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $todo->attachment) }}" target="_blank" class="inline-block mt-2 text-sm text-gray-700 hover:text-black hover:underline">
                                    Download {{ $todo->attachment_name }}
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Actions: edit and delete -->
                <div class="flex gap-3 text-sm shrink-0">
                    <a href="{{ route('todos.edit', $todo) }}" class="text-gray-600 hover:text-gray-900 hover:underline">Edit</a>

                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Delete this todo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>

        @if ($loop->last)
            </div>
        @endif
    @empty
        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center text-gray-500">
            No todos yet. Add your first one!
        </div>
    @endforelse
@endsection
