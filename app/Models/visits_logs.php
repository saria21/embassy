<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('visits_log')]
class visits_logs extends Model
{
    use HasFactory;
    protected $primaryKey = 'visit_id';
    protected $fillable = [
        'visitor_id',
        'staff_id',
        'check_in_time',
        'check_out_time',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(staff::class, 'staff_id', 'staff_id');
    }
}
