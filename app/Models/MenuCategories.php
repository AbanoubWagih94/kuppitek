<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
