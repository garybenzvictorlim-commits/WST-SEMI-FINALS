@extends('layouts.app')

@section('title', 'New Task')

@section('content')

    <div style="max-width: 560px; margin: 0 auto;">
        <h1 style="font-size: 24px; margin-bottom: 4px;">New Task</h1>
        <p style="color: var(--text-dim); font-size: 14px; margin-top: 0; margin-bottom: 24px;">Add something to the board.</p>

        <div class="panel" style="padding: 28px;">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label>Task Name</label>
                    <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="e.g. Finish ERD diagram" autofocus>
                    @error('task_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label>Description</label>
                    <textarea name="description" placeholder="Optional details...">{{ old('description') }}</textarea>
                    @error('description') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px;">
                    <div>
                        <label>Status</label>
                        <select name="status">
                            <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label>Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}">
                        @error('due_date') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div style="display:flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Create Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
