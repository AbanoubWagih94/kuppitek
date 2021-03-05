<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function category(){
     return   $this->belongsTo("App\Models\MenuCategories",'category_id','id');
    }

}
