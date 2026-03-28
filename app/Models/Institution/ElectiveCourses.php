<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;
use App\Models\SkillsCategory;
use App\Models\SkillSubcategory;
use App\Models\Institution\Faculty;

class ElectiveCourses extends Model
{
    protected $table = 'electives_courses';
    protected $primaryKey = 'elective_id';

    protected $fillable = [
        'institution_id',
        'elective_title',
        'faculty_id',
        'category_id',
        'duration',
        'price',
        'start_date',
        'description',
        'status'
    ];

    // Faculty Relation
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
    }

    // Category Relation
    public function category()
    {
        return $this->belongsTo(SkillsCategory::class, 'category_id', 'id');
    }

    // Subcategory / Skills Relation (Many to Many)
    public function skills()
    {
        return $this->belongsToMany(
            SkillSubcategory::class,
            'elective_skills',
            'elective_id',
            'skill_id'
        );
    }
}