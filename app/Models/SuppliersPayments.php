<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersPayments extends Model
{
    use HasFactory;
    
    protected $fillable = ['supplier_id', 'payment_id'];
}
