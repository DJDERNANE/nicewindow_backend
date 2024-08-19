<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpentryProfileOrderProducts extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'profile_id', 'qty', 'unit_price', 'profit','remise'];

    protected $table = 'carpentry_profiles_order_products';

    public function profile_order()
    {
        return $this->belongsTo(CarpentryProfileOrder::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
