<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name_en', 'name_fr', 'name_ar'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->hasMany(type::class);
    }
}
