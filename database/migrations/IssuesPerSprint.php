<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuesPerSprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'sprint_id',
        'issue_id',
        'workflow_id',
    ];
}
