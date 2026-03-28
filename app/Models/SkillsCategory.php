<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillsCategory extends Model
{
    public function subcategories()
{
    return $this->hasMany(SkillSubcategory::class, 'skills_category_id','id');
}
}
