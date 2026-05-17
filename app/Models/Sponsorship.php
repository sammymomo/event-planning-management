<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sponsorship extends Model
{
    protected $fillable = [
        'sponsor_id',
        'event_id',
        'amount',
        'resource_type',
        'acknowledged',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'acknowledged' => 'boolean',
        ];
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
