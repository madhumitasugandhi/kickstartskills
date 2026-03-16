<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subregion extends Model
{
    use HasFactory;

    protected $table = 'subregions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'translations',
        'region_id',
        'flag',
        'wikiDataId'
    ];

    protected $casts = [
        'flag' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'subregion_id');
    }
}