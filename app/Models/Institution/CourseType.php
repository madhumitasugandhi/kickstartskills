<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;

    protected $table = 'course_types';

    protected $primaryKey = 'course_type_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'course_name',
        'duration_years',
        'duration_months',
        'code_extension'
    ];

    protected $casts = [
        'duration_years' => 'integer',
        'duration_months' => 'integer',
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

    public function requirements()
{
    return $this->belongsToMany(
        CourseRequirement::class,
        'course_type_requirements',
        'course_type_id',
        'requirement_id'
    );
}
}