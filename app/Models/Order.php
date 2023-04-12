<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    public function users()
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }
    public function order_detail()
    {
        return $this->belongsTo(OrderDetails::class ,'id','order_id');
    }
}
