<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentProfile extends Model
{
    // This allows Laravel to save data to your 45 tables
    protected $guarded = [];

    // Every profile belongs to one User in your 'users' table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
