<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Whether the task is overdue (past due date and still pending).
     */
    public function isOverdue(): bool
    {
        return $this->status === 'Pending'
            && $this->due_date
            && $this->due_date->isPast();
    }
}
