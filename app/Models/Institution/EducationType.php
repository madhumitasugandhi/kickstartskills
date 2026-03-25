<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationType extends Model
{
    use HasFactory;

    protected $table = 'education_types';

    protected $fillable = [
        'education_type_name',
        'education_type_code',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Relationship with Programs
     */
    public function programs()
    {
        return $this->hasMany(InstitutionProgram::class, 'education_type_id');
    }
}