<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'project_id',
        'role',
        'user_id',
        'registered',
        'accepted'
    ];
}
