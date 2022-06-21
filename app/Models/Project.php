<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'uuid',
        'slug',
        'image',
        'description',
        'initial_date',
        'projected_end_date',
        'status',
        'owner_id',
        'qa_id',
        'client_id',
        'company_id',
        'line_id',
        'project_type_id'
    ];
}
