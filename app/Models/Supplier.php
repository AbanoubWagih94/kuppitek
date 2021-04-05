<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number', 'address'];

    public function payments() {
        return $this->belongsToMany(Payments::class, 'suppliers_payments', 'supplier_id', 'payment_id')->withPivot('id');
    }
}
