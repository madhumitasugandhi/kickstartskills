<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionSetupProgress extends Model
{
    use HasFactory;

    protected $table = 'institution_setup_progress';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [

        'institution_id',
        'basic_info_completed',
        'academic_completed',
        'courses_completed',
        'code_setup_completed',
        'regulatory_completed',
        'admin_completed',
        'documents_uploaded'
    ];

    protected $casts = [

        'basic_info_completed' => 'boolean',
        'academic_completed' => 'boolean',
        'courses_completed' => 'boolean',
        'code_setup_completed' => 'boolean',
        'regulatory_completed' => 'boolean',
        'admin_completed' => 'boolean',
        'documents_uploaded' => 'boolean'
    ];
}