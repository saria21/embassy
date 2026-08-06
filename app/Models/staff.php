<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('staff')]
class staff extends Model
{
    use HasFactory;
    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'full_name',
        'job_title',
        'role',
        'department_id',
    ];

    public function auth(): HasOne
    {
        return $this->hasOne(auth::class, 'staff_id', 'staff_id');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(department::class, 'department_id', 'department_id');
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(appointments::class, 'interviewer_staff_id', 'staff_id');
    }

    public function visitsLogs(): HasMany
    {
        return $this->hasMany(visits_logs::class, 'staff_id', 'staff_id');
    }
}
