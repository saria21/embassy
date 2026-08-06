<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('auths')]
class Auth extends Model
{
    use HasFactory;
    protected $primaryKey = 'auth_id';

    protected $fillable = [
        'staff_id',
        'role_id',
        'password_hash',
        'last_login',
    ];

    // Links this authentication account profile back to the individual employee row
    public function staff(): BelongsTo
    {
        // (Target class, Current table column name, Target table key name)
        return $this->belongsTo(staff::class, 'staff_id', 'staff_id');
    }
}
