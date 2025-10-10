<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informations';

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'email'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
