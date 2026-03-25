<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionDepartment extends Model
{
    use HasFactory;

    protected $table = 'institution_departments';

    protected $primaryKey = 'department_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'department_name'
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
    public function faculties()
{
    return $this->hasMany(Faculty::class, 'department_id');
}
}