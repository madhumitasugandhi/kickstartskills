<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionAdmin extends Model
{
    use HasFactory;

    protected $table = 'institution_admins';

    protected $primaryKey = 'admin_id';

    public $timestamps = false;

    protected $fillable = [
        'institution_id',
        'name',
        'email',
        'phone',
        'designation',
        'password_hash'
    ];

    protected $casts = [
        'created_at' => 'datetime',
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
}