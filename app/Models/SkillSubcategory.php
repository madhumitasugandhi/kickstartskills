<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mentor\Drive;


class SkillSubcategory extends Model
{
    // Important: Tell Laravel the custom table name
    protected $table = 'skills_subcategories';

    public function category()
    {
        return $this->belongsTo(SkillsCategory::class, 'skills_category_id','id');
    }

    public function drives()
{
    return $this->belongsToMany(
        Drive::class,
        'drive_skills',
        'skill_subcategory_id',
        'drive_id'
    );
}
}
