<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrProfile extends Model
{
    // This allows Laravel to save data to your 45 tables
    protected $guarded = [];

    // Every profile belongs to one User in your 'users' table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
