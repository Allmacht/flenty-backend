<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'summary',
        'description',
        'duration',
        'status',
        'assignee_id',
        'reporter_id',
        'priority_id',
        'issue_type_id',
        'project_id'
    ];
}
