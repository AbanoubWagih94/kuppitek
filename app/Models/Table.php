<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $fillable = ['table_number', 'table_status'];


    public function users() {
        return $this->belongsToMany(User::class, 'user_tables', 'table_id', 'user_id');
        }
=======
>>>>>>> 562035a9656416f6964f6b66c4e71496c2813570
}
