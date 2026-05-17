<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VolunteerTask extends Model
{
    protected $fillable = [
        'event_id',
        'task_name',
        'description',
        'slots_available',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(VolunteerAssignment::class, 'task_id');
    }

    public function slotsRemaining(): int
    {
        return $this->slots_available - $this->assignments()->count();
    }
}
