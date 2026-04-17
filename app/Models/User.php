<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin\AdminProfile;
use App\Models\Institution\Institution;

class User extends Authenticatable
{
    public $timestamps = false;
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN_STAFF = 2;
    const ROLE_STUDENT = 3;
    const ROLE_INSTITUTION = 4; 
    const ROLE_MENTOR = 5;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone',
        'country',
        'institution_code',
        'institution_name',
        'admin_role_id',
        'account_status',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Inside app/Models/User.php

    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function studentProfile()
    {
        return $this->hasOne(\App\Models\Student\StudentProfile::class, 'user_id');
    }

    public function mentorProfile()
    {
        return $this->hasOne(\App\Models\Mentor\MentorProfile::class, 'user_id');
    }

    public function hrProfile()
    {
        return $this->hasOne(HrProfile::class);
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'user_id');
    }
}
