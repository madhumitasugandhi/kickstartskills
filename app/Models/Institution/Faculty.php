<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institution\Department;
use App\Models\Institution\CourseType;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    protected $fillable = [
        'institution_id',
        'department_id',
        'name',
        'email',
        'phone',
        'designation',
        'specialization',
        'experience',
        'status',
        'created_by'
    ];

    /* ================= RELATIONSHIPS ================= */

    public function department()
{
    return $this->belongsTo(InstitutionDepartment::class, 'department_id');
}

public function courses()
{
    return $this->belongsToMany(
        CourseType::class,
        'faculty_courses',
        'faculty_id',
        'course_type_id'
    );
}
}