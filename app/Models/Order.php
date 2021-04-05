<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'table_id', 'counter_id', 'user_id', 'total_cost', 'order_status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('item_qty','item_status');
    }
    public function table() {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function waiter() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
