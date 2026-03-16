<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTypeRequirement extends Model
{
    use HasFactory;

    protected $table = 'course_type_requirements';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'course_type_id',
        'requirement_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id');
    }

    public function requirement()
    {
        return $this->belongsTo(CourseRequirement::class, 'requirement_id');
    }
}