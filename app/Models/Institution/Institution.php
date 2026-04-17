<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mentor\Drive;
use App\Models\User;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $primaryKey = 'institution_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'institution_name',
        'institution_code_prefix',
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


    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'created_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    public function accreditations()
    {
    return $this->hasMany(InstitutionAccreditation::class,'institution_id','institution_id');
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

    // drive
    public function drives()
{
    return $this->belongsToMany(
        Drive::class,
        'drive_institutions',
        'institution_id',
        'drive_id'
    );
}

    
}
