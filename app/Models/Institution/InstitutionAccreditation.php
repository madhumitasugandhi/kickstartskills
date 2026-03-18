<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;

class InstitutionAccreditation extends Model
{
    protected $table = 'institution_accreditations';

    protected $primaryKey = 'accreditation_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'accreditation_body_id',
        'registration_number',
        'accreditation_status',
        'accreditation_expiry_date'
    ];

    // ================= RELATIONS =================

    public function institution()
    {
        return $this->belongsTo(
            \App\Models\Institution\Institution::class,
            'institution_id',
            'institution_id'
        );
    }

    public function accreditationBody()
    {
        return $this->belongsTo(
            AccreditationBody::class,
            'accreditation_body_id',
            'accreditation_body_id'
        );
    }
}