<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionDrive extends Model
{
    use HasFactory;

    protected $table = 'institutions_drive';

    public const STATUS_DRAFT = 'draft';
    public const STATUS_OPEN = 'open';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'drive_name',
        'description',
        'company_name',
        'drive_date',
        'interview_start_date',
        'interview_end_date',
        'application_deadline',
        'stipend',
        'location',
        'status',
        'institution_id'
    ];

    protected $casts = [
        'drive_date' => 'date',
        'interview_start_date' => 'date',
        'interview_end_date' => 'date',
        'application_deadline' => 'date',
        'stipend' => 'decimal:2'
    ];
}