<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sub_category()
    {
        return $this->hasMany(SubCategories::class ,'category_id' ,'id');
    }

}
