<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'table_id', 'total_cost', 'order_status'];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->belongsToMany(MenuItems::class, 'order_items', 'order_id', 'item_id')->withPivot('item_qty');
    }
}
