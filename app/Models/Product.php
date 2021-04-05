<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['title', 'category_id', 'sub_category_id', 'quantity', 'cost_price', 'selling_price', 'ingredients', 'image_path'];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(MenuCategories::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
