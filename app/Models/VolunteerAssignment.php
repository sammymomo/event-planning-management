<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerAssignment extends Model
{
    public $timestamps = false;

    protected $attributes = [
        'availability' => null,
    ];

    protected $fillable = [
        'user_id',
        'task_id',
        'availability',
        'assigned_at',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (VolunteerAssignment $assignment) {
            $assignment->assigned_at ??= now();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(VolunteerTask::class, 'task_id');
    }
}
