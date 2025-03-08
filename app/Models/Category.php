<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function foodMenus()
    {
        return $this->hasMany(FoodMenu::class);
    }
}
