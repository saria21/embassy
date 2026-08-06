<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('visa_applications')]
class visa_applications extends Model
{
    use HasFactory;
    protected $primaryKey = 'application_id';

    protected $fillable = [
        'applicant_id',
        'visa_type',
        'application_status',
    ];
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(visa_applicants::class, 'applicant_id', 'applicant_id');
    }
}
