<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionProgram extends Model
{
    use HasFactory;

    protected $table = 'institution_programs';

    protected $primaryKey = 'program_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'department_id',
        'program_name',
        'fees',
        'duration',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'fees' => 'decimal:2'
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

    public function department()
    {
        return $this->belongsTo(InstitutionDepartment::class, 'department_id');
    }
}