<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_fr', 'name_ar'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function subcategory()
    {
        return $this->hasOne(Subcategory::class);
    }


    public function type()
    {
        return $this->hasOne(type::class);
    }
}
