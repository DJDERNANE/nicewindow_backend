<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProfileStock extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'profile_id', 'typeId','colorId','category_id', 'profile_name', 'price', 'qty','prixAchat'];

    protected $table = 'supplier_profiles_stock';

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'colorId');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'typeId');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
