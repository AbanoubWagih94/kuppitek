<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    protected $guarded=[];

    public function category(){
     return   $this->belongsTo("App\Models\MenuCategories",'category_id','id');
    }

>>>>>>> 562035a9656416f6964f6b66c4e71496c2813570
}
