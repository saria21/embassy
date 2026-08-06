<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('citizens')]
class citizen extends Model
{
    use HasFactory;

    protected $primaryKey = 'citizen_id';

    protected $fillable = [
        'passport_number',
        'full_name',
        'current_address',
    ];

    // Links a citizen to all their booked appointments
    public function appointments(): HasMany
    {
        return $this->hasMany(appointments::class, 'citizen_id', 'citizen_id');
    }

    // Links a citizen to all their consular requests
    public function consularRequests(): HasMany
    {
        return $this->hasMany(consular_request::class, 'citizen_id', 'citizen_id');
    }
}
