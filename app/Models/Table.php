<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['table_number', 'table_status'];


    public function users() {
        return $this->belongsToMany(User::class, 'user_tables', 'table_id', 'user_id');
    }
    public function orders() {
        return $this->hasMany(Order::class,);
    }
}
