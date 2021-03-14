<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'table_id', 'total_cost', 'order_status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function items()
    {
        return $this->belongsToMany(MenuItems::class, 'order_items', 'order_id', 'item_id')->withPivot('item_qty');
    }
    public function table() {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
