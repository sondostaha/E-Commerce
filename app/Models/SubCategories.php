<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Categories::class ,'category_id','id');
    }
    public function product()
    {
        return $this->hasMany(Product::class ,'sub_category','id');
    }
}
