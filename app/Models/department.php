<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Table('departments')]
class department extends Model
{
    use HasFactory;
    protected $primaryKey = 'department_id';

    protected $fillable = [
        'name',
        'building_id',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(related_buildings::class, 'building_id', 'id');
    }

        public function staffMembers(): HasMany
    {
        return $this->hasMany(staff::class, 'department_id', 'department_id');
    }
}
