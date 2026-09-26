@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

    <div style="max-width: 560px; margin: 0 auto;">
        <h1 style="font-size: 24px; margin-bottom: 4px;">Edit Task</h1>
        <p style="color: var(--text-dim); font-size: 14px; margin-top: 0; margin-bottom: 24px;">Update the details below.</p>

        <div class="panel" style="padding: 28px;">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label>Task Name</label>
                    <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}" autofocus>
                    @error('task_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $task->description) }}</textarea>
                    @error('description') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px;">
                    <div>
                        <label>Status</label>
                        <select name="status">
                            <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label>Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                        @error('due_date') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div style="display:flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
