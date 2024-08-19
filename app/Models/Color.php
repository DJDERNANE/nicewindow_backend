<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'name_fr', 'color_code'];

     public function stock()
    {
        return $this->hasOne(SupplierProfileStock::class);
    }
}
