<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'iso3',
        'numeric_code',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'currency_symbol',
        'tld',
        'native',
        'population',
        'gdp',
        'region',
        'region_id',
        'subregion',
        'subregion_id',
        'nationality',
        'area_sq_km',
        'postal_code_format',
        'postal_code_regex',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'flag',
        'wikiDataId',
    ];

    protected $casts = [
        'population' => 'integer',
        'gdp' => 'integer',
        'area_sq_km' => 'float',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'flag' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function region()
{
    return $this->belongsTo(Region::class, 'region_id');
}


public function subregion()
{
    return $this->belongsTo(Subregion::class, 'subregion_id');
}

public function states()
{
    return $this->hasMany(State::class, 'country_id');
}

}