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
    public $timestamps = true;
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN_STAFF = 2;
    const ROLE_MENTOR = 3;
const ROLE_INSTITUTION = 4;
const ROLE_STUDENT = 5;
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
        'mentor_id',
        
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

    protected static function booted()
{
    static::created(function ($user) {

        // Create Institution automatically
        if ($user->admin_role_id == self::ROLE_INSTITUTION) {

            if (!$user->institution) {

                Institution::create([
                    'user_id' => $user->id,
                    'institution_name' => $user->full_name,
                    'email' => $user->email,
                    'status' => $user->account_status,
                    'setup_status' => 'registered',
                    'password_hash' => $user->password
                ]);
            }
        }
    });

    static::updated(function ($user) {

        // Sync Institution on update
        if ($user->admin_role_id == self::ROLE_INSTITUTION && $user->institution) {

            $user->institution->update([
                'institution_name' => $user->full_name,
                'email' => $user->email,
                'status' => $user->account_status,
            ]);
        }
    });

    static::deleting(function ($user) {

        // Delete institution if user deleted
        if ($user->admin_role_id == self::ROLE_INSTITUTION && $user->institution) {
            $user->institution->delete();
        }
    });
}
    public function institution()
    {
        return $this->hasOne(Institution::class, 'user_id');
    }


}
