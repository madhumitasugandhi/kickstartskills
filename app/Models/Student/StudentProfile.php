<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * StudentProfile Model
 * * Fields in 'student_profiles' table:
 * @property int $user_id
 * @property string|null $phone
 * @property string|null $gender
 * @property string|null $dob
 * @property string|null $blood_group
 * @property string|null $institution_id
 * @property string|null $enrollment_number
 * @property string|null $bio
 * @property string|null $linkedin_url
 * @property string|null $github_url
 * @property string|null $resume_url
 */
class StudentProfile extends Model
{
    protected $table = 'student_profiles';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
