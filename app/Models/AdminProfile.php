<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    // This allows Laravel to insert data into the table
    protected $guarded = [];

    // This is the reverse relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
