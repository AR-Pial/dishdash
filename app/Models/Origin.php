<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    //
    protected $fillable = ['name', 'description'];

    public function foodMenus()
    {
        return $this->hasMany(FoodMenu::class);
    }
}
