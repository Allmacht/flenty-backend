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

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function issue_type()
    {
        return $this->belongsTo(IssueType::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->hasMany(AttachedFile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }


}
