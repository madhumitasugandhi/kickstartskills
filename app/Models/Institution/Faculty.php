<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institution\InstitutionDepartment;
use App\Models\Institution\CourseType;
use App\Models\Institution\ElectiveCourses;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $primaryKey = 'faculty_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'institution_id',
        'department_id',
        'name',
        'email',
        'phone',
        'designation',
        'employment_type', 
        'specialization',
        'experience',
        'status',
        'created_by'
    ];

    public function department()
    {
        return $this->belongsTo(InstitutionDepartment::class, 'department_id','department_id');
    }

    public function courses()
    {
        return $this->belongsToMany(
            CourseType::class,
            'faculty_courses',
            'faculty_id',
            'course_type_id',
            'faculty_id',
            'course_type_id'
        );
    }

    public function electives()
{
    return $this->hasMany(
        ElectiveCourses::class,
        'faculty_id',
        'faculty_id'
    );
}
}