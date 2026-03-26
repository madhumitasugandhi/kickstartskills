<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elective extends Model
{
    use SoftDeletes;

    protected $table = 'electives';

    protected $fillable = [
        'name',
        'department_id',
        'duration',
        'description',
        'fees',
        'status'
    ];

    protected $casts = [
        'fees' => 'decimal:2',
        'status' => 'boolean'
    ];

    /**
     * Department Relationship
     */
    public function department()
    {
        return $this->belongsTo(InstitutionDepartment::class,'department_id', 'department_id');
    }
}