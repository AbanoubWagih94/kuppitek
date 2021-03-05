<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['title'];

    public function users(){
        return $this->hasMany(User::class);
    }
=======
>>>>>>> 562035a9656416f6964f6b66c4e71496c2813570
}
