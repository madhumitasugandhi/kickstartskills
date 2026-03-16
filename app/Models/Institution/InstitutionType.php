<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstitutionType extends Model
{
    use HasFactory;

    protected $table = 'institution_types';

    protected $primaryKey = 'institution_type_id';

    public $timestamps = false;

    protected $fillable = [
        'type_name',
        'description'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function institutions()
    {
        return $this->hasMany(Institution::class, 'institution_type_id');
    }
}