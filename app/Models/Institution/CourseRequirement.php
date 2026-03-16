<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRequirement extends Model
{
    use HasFactory;

    protected $table = 'course_requirements';

    protected $primaryKey = 'requirement_id';

    public $timestamps = false;

    protected $fillable = [
        'requirement_name'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function courseTypes()
    {
        return $this->belongsToMany(
            CourseType::class,
            'course_type_requirements',
            'requirement_id',
            'course_type_id'
        );
    }
}