<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;

class UsersPerProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'role_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
