<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'department_id',
        'joining_date'
    ];

    public function departmentInfo(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}