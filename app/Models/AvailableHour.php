<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AvailableHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'day',
        'start_time',
        'availability'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function donation(): HasOne
    {
        return $this->hasOne(Donation::class);
    }
}
