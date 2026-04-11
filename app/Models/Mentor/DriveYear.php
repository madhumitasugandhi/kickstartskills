<?php

namespace App\Models\Mentor;

use Illuminate\Database\Eloquent\Model;

class DriveYear extends Model
{
    protected $table = 'drive_years';

    protected $fillable = [
        'drive_id',
        'year'
    ];

    public function drive()
    {
        return $this->belongsTo(Drive::class, 'drive_id');
    }
}