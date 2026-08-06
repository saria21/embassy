<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('consular_requests')]
class consular_request extends Model
{
    use HasFactory;
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'citizen_id',
        'request_type',
        'request_status',
    ];
    public function citizen(): BelongsTo
    {
        return $this->belongsTo(citizen::class, 'citizen_id', 'citizen_id');
    }
}
