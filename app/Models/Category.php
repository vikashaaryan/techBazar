<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'cat_title',
        'description',
        'parent_cat',
    ];

    public function parent()
    {
        return $this->hasOne(Category::class, "id", "parent_cat");
    }
}
