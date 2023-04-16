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
    public function products()
    {
        return $this->hasMany(Product::class ,'id','sub_category');
    }
}
