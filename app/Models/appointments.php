<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
#[Table('appointments')]
class appointments extends Model
{
    use HasFactory;
    protected $primaryKey = 'appointment_id';
    protected $fillable = [
        'applicant_id',
        'citizen_id',
        'interviewer_staff_id',
        'appointment_date',
        'purpose_of_visit',
    ];

    public function visaApplicant(): BelongsTo
    {
        return $this->belongsTo(visa_applicants::class, 'applicant_id', 'applicant_id');
    }
    public function citizen(): BelongsTo
    {
        return $this->belongsTo(citizen::class, 'citizen_id', 'citizen_id');
    }    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(staff::class, 'interviewer_staff_id', 'staff_id');
    }
}
