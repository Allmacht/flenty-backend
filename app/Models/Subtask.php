<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtask',
        'value',
        'issue_id',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
