<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    protected $fillable = ['counter_number', 'counter_status'];

    public function users() {
        return $this->belongsToMany(User::class, 'counter_users', 'counter_id', 'user_id')->withPivot('start_money', 'created_at');
    }
}
