<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('visa_applicants')]
class visa_applicants extends Model
{
    use HasFactory;
    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'passport_number',
        'full_name',
        'nationality',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(visa_applications::class, 'applicant_id', 'applicant_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(appointments::class, 'applicant_id', 'applicant_id');
    }
}
