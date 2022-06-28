<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachedFile extends Model
{
    use HasFactory;

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
