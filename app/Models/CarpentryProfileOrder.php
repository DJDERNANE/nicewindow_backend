<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryProfileOrder extends Model
{
    use HasFactory;

    protected $fillable = ['carpentry_id', 'supplier_id', 'unit_price', 'shipping_address', 'shipping_price', 'total_price', 'status', 'payment_status', 'paye', 'credit','profit', 'remise'];

    protected $table = 'carpentry_profiles_orders';

    public function carpentry()
    {
        return $this->belongsTo(User::class, 'carpentry_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function profile_order_products()
    {
        return $this->hasMany(CarpentryProfileOrderProducts::class, 'order_id');
    }
}
