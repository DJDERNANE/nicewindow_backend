<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id','category_id', 'subcategory_id', 'ref', 'icon', 'name', 'weight', 'height', 'price_m', 'price_bar'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function type()
    {
        return $this->belongsTo(type::class);
    }

    public function supplier_profiles_stock()
    {
        return $this->hasOne(SupplierProfileStock::class);
    }

    public function carpentry_profile_order()
    {
        return $this->hasOne(CarpentryProfileOrder::class);
    }

    public function carpentry_profiles_order_cart()
    {
        return $this->hasOne(CarpentryProfilesOrderCart::class);
    }

    public function carpentry_profile_order_product()
    {
        return $this->hasOne(CarpentryProfileOrderProducts::class);
    }
    public function supplier()
    {
        return $this->belongsTo(User::class);
    }
}
