<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterUsers extends Model
{
    use HasFactory;
    protected $fillable = ['counter_id', 'user_id', 'start_money'];
}
