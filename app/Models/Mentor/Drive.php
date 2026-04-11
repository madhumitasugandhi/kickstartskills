<?php

namespace App\Models\Mentor;

use Illuminate\Database\Eloquent\Model;
use App\Models\Institution\Institution;
use App\Models\Institution\CourseType;
use App\Models\Institution\InstitutionDepartment;
use App\Models\SkillSubcategory;
class Drive extends Model
{
    protected $primaryKey = 'drive_id';

    protected $fillable = [
        'mentor_id',
        'drive_title',
        'drive_description',
        'job_description',
        'drive_type',
        'mentorship_level',
        'location',
        'work_mode',
        'remote_allowed',
        'positions',
        'hours_per_week',
        'min_cgpa',
        'min_attendance',
        'application_start',
        'application_end',
        'internship_start',
        'internship_end',
        'duration_weeks',
        'flexible_duration',
        'is_paid',
        'amount',
        'currency',
        'payment_frequency',
        'payment_terms',
        'status'
    ];

    /* ================= Relationships ================= */

    public function institutions()
    {
        return $this->belongsToMany(
            Institution::class,
            'drive_institutions',
            'drive_id',
            'institution_id'
        );
    }

    public function courses()
    {
        return $this->belongsToMany(
            CourseType::class,
            'drive_courses',
            'drive_id',
            'course_type_id'
        );
    }

    public function departments()
    {
        return $this->belongsToMany(
            InstitutionDepartment::class,
            'drive_departments',
            'drive_id',
            'department_id'
        );
    }

    public function skills()
    {
        return $this->belongsToMany(
            SkillSubcategory::class,
            'drive_skills',
            'drive_id',
            'skill_subcategory_id'
        );
    }

    public function years()
    {
        return $this->hasMany(DriveYear::class, 'drive_id');
    }
}