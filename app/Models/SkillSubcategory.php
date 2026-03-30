<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillSubcategory extends Model
{
    // Important: Tell Laravel the custom table name
    protected $table = 'skills_subcategories';

    public function category()
    {
        return $this->belongsTo(SkillsCategory::class, 'skills_category_id','id');
    }
}
