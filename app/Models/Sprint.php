<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'initial_date',
        'projected_end_date',
        'goal',
        'project_id'
    ];


    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }
}
