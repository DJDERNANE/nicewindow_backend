<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'catid', 'subcatid'];
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function stock()
    {
        return $this->hasOne(SupplierProfileStock::class);
    }

}
