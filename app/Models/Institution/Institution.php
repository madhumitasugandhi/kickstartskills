<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $primaryKey = 'institution_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_name',
        'institution_code',
        'email',
        'status',
        'setup_status',
        'legal_name',
        'institution_type_id',
        'representative_name',
        'phone',
        'password_hash',
        'terms_accepted',
        'remember_token',
        'website',
        'established_year',

        // regulatory fields
        'aishe_code',
        'aicte_id',
        'ugc_number',
        'affiliated_university',

        // code generation settings
        'code_prefix',
        'code_format',
        'include_year'
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'include_year' => 'boolean',
        'created_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function institutionType()
    {
        return $this->belongsTo(InstitutionType::class, 'institution_type_id');
    }

    public function addresses()
    {
        return $this->hasMany(InstitutionAddress::class, 'institution_id');
    }

    public function departments()
    {
        return $this->hasMany(InstitutionDepartment::class, 'institution_id');
    }

    public function programs()
    {
        return $this->hasMany(InstitutionProgram::class, 'institution_id');
    }

    public function courseTypes()
    {
        return $this->hasMany(CourseType::class, 'institution_id');
    }
    public function admins()
    {
        return $this->hasMany(InstitutionAdmin::class, 'institution_id');
    }

    public function documents()
    {
        return $this->hasMany(InstitutionDocument::class, 'institution_id');
    }
}
