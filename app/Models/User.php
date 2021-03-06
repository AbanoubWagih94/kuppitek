<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['role_id', 'user_name', 'name', 'password'];
    protected $hidden = ['password'];

    public function userRole() {
       return $this->belongsTo(Role::class, 'role_id');
    }

    public function tables() {
        return $this->belongsToMany(Table::class, 'user_tables', 'user_id', 'table_id');
        }
}
