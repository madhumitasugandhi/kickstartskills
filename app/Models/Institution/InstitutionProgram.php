<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionProgram extends Model
{
    use HasFactory;

    protected $table = 'institution_programs';

    protected $primaryKey = 'program_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'department_id',
        'education_type_id',
        'program_name',
        'coordinator',
        'semesters',
        'max_intake',
        'duration',
        'description',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function department()
    {
        return $this->belongsTo(InstitutionDepartment::class, 'department_id');
    }

    public function educationType()
{
    return $this->belongsTo(EducationType::class, 'education_type_id');
}
}