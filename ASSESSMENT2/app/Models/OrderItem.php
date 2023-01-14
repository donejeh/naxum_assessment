<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class,'purchaser_id','id');
    }

}
