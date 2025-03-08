<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    //
    use HasFactory;

    protected $table = 'food_menus';

    protected $fillable = [
        'food_item_name',
        'description',
        'price',
        'unit_id',
        'category_id',
        'sub_category_id',
        'origin_id',
    ];
    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id');
    }
}
