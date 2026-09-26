@extends('layouts.app')

@section('title', 'Board')

@section('content')

    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px;">
        <div class="panel" style="padding: 20px;">
            <div style="color: var(--text-dim); font-size: 13px; margin-bottom: 6px;">Total Tasks</div>
            <div class="stat-num" style="font-size: 28px; font-weight: 700;">{{ $stats['total'] }}</div>
        </div>
        <div class="panel" style="padding: 20px;">
            <div style="color: var(--text-dim); font-size: 13px; margin-bottom: 6px;">Pending</div>
            <div class="stat-num" style="font-size: 28px; font-weight: 700; color: var(--pending);">{{ $stats['pending'] }}</div>
        </div>
        <div class="panel" style="padding: 20px;">
            <div style="color: var(--text-dim); font-size: 13px; margin-bottom: 6px;">Completed</div>
            <div class="stat-num" style="font-size: 28px; font-weight: 700; color: var(--completed);">{{ $stats['completed'] }}</div>
        </div>
    </div>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 18px; flex-wrap: wrap; gap: 12px;">
        <div style="display:flex; gap: 8px;">
            <a href="{{ route('tasks.index') }}" class="btn btn-sm {{ $filter === 'all' ? 'btn-primary' : 'btn-ghost' }}">All</a>
            <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="btn btn-sm {{ $filter === 'pending' ? 'btn-primary' : 'btn-ghost' }}">Pending</a>
            <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-sm {{ $filter === 'completed' ? 'btn-primary' : 'btn-ghost' }}">Completed</a>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
    </div>

    @if ($tasks->isEmpty())
        <div class="panel" style="padding: 60px 20px; text-align: center; color: var(--text-dim);">
            <div style="font-size: 32px; margin-bottom: 12px;">✦</div>
            No tasks here yet. <a href="{{ route('tasks.create') }}" style="color: var(--accent-a);">Create your first one</a>.
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach ($tasks as $task)
                <div class="panel" style="padding: 18px 20px; display:flex; align-items:center; gap: 16px;">

                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" title="Toggle status" style="
                            width: 26px; height: 26px; border-radius: 50%; cursor: pointer;
                            border: 2px solid {{ $task->status === 'Completed' ? 'var(--completed)' : 'var(--pending)' }};
                            background: {{ $task->status === 'Completed' ? 'var(--completed)' : 'transparent' }};
                            display:flex; align-items:center; justify-content:center; color: #0b0d14; font-size: 14px; flex-shrink:0;
                        ">{{ $task->status === 'Completed' ? '✓' : '' }}</button>
                    </form>

                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 15px; {{ $task->status === 'Completed' ? 'text-decoration: line-through; color: var(--text-dim);' : '' }}">
                            {{ $task->task_name }}
                        </div>
                        @if ($task->description)
                            <div style="color: var(--text-dim); font-size: 13px; margin-top: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $task->description }}
                            </div>
                        @endif
                    </div>

                    @if ($task->due_date)
                        <div style="font-size: 13px; color: {{ $task->isOverdue() ? 'var(--danger)' : 'var(--text-dim)' }}; flex-shrink:0;">
                            {{ $task->isOverdue() ? '⚠ overdue' : '' }} {{ $task->due_date->format('M d, Y') }}
                        </div>
                    @endif

                    <div style="flex-shrink:0; padding: 5px 12px; border-radius: 999px; font-size: 12px; font-weight: 600;
                        background: {{ $task->status === 'Completed' ? 'rgba(56,229,196,0.12)' : 'rgba(255,180,84,0.12)' }};
                        color: {{ $task->status === 'Completed' ? 'var(--completed)' : 'var(--pending)' }};">
                        {{ $task->status }}
                    </div>

                    <div style="display:flex; gap: 8px; flex-shrink:0;">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-ghost btn-sm">Edit</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
