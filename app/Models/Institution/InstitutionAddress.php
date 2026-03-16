<?php

namespace App\Models\Institution;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstitutionAddress extends Model
{
    use HasFactory;

    protected $table = 'institution_addresses';

    protected $primaryKey = 'address_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'country_id',
        'state_id',
        'city_id',
        'address_line1',
        'address_line2',
        'postal_code'
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}