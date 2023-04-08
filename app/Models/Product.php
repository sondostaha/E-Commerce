<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Query\OrExpr;

class Product extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function product_deltail()
    {
        return $this->belongsTo(ProductDetails::class ,'product_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class ,'product_id','id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategories::class ,'product_id','id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class );
    }
}
