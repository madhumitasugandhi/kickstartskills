<?php

namespace App\Models\Mentor;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class MentorProfile extends Model
{
    protected $table = 'mentor_profiles';

    protected $guarded = [];

    protected $casts = [
        'available_days' => 'array',
        'time_preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
