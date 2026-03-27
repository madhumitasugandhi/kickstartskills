<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;
use App\Models\SkillsCategory;
use App\Models\SkillSubcategory;

class ElectiveCourses extends Model
{
    protected $table = 'electives_courses';
    protected $primaryKey = 'elective_id';

    protected $fillable = [
        'institution_id',
        'elective_title',
        'instructor_name',
        'category_id',
        'duration',
        'price',
        'start_date',
        'description',
        'status'
    ];

    // Category Relation
    public function category()
    {
        return $this->belongsTo(SkillsCategory::class, 'category_id', 'category_id');
    }

    // Skills Relation (Many to Many)
    public function skills()
    {
        return $this->belongsToMany(
            SkillSubcategory::class,
            'elective_skills',
            'elective_id',
            'subcategory_id'
        );
    }
}