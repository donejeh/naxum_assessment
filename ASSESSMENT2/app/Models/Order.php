<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'purchaser_id','id');
    }

    public function orderItem()
    {
        return $this->has(OrderItem::class,'purchaser_id','id');
    }

    public function product() 
{
    return $this->belongsToMany(
        Product::class, 
        'order_items', 
        'order_id', 
        'product_id'
    )->withPivot('qantity');;
}




}
