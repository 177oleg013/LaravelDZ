<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    public const STATUSES = [
        'todo' => 'Заплановано',
        'in_progress' => 'В роботі',
        'done' => 'Виконано',
    ];

    public const STATUS_BADGES = [
        'todo' => 'badge-info',
        'in_progress' => 'badge-warning',
        'done' => 'badge-success',
    ];

    protected $fillable = [
        'title',
        'body',
        'status',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function statusBadge(): string
    {
        return self::STATUS_BADGES[$this->status] ?? 'badge-ghost';
    }

    public function isOverdue(): bool
    {
        return $this->due_date !== null && $this->status !== 'done' && $this->due_date->isPast() && ! $this->due_date->isToday();
    }
}
