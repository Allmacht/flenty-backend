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

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
