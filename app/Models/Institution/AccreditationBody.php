<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;

class AccreditationBody extends Model
{
    protected $table = 'accreditation_bodies';

    protected $primaryKey = 'accreditation_body_id';

    public $timestamps = false;

    protected $fillable = [
        'body_name'
    ];

    // ================= RELATION =================
    public function institutionAccreditations()
    {
        return $this->hasMany(InstitutionAccreditation::class, 'accreditation_body_id');
    }
}